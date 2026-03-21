

# Fix: Badge "0" dorado en sidebar + Redirección de capítulos padre en WordPress

## Problemas identificados

1. **Sin redirección para capítulos padre**: En React, `Chapter.tsx` redirige automáticamente capítulos con hijos a su primer subcapítulo (`Navigate to={children[0].slug}`). WordPress no tiene esta lógica — acceder a "Prólogos" muestra su contenido propio en vez de redirigir a Fernando Clavijo.

2. **Badge "0" posiblemente ausente**: Si el contenido fue importado antes de añadir el soporte para `strlen('0')`, el meta `_numero_capitulo` puede no existir en la base de datos. El código PHP actual (`strlen($numero) > 0`) es correcto, pero el dato podría faltar.

## Plan de implementación

### 1. Añadir redirección de capítulos padre (`functions.php`)

Añadir un hook `template_redirect` que detecte capítulos con hijos y redirija al primer subcapítulo, idéntico al comportamiento de React:

```php
function libro_redirect_parent_chapters() {
    if (!is_singular('capitulo')) return;
    
    $children = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => 1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_parent'    => get_the_ID(),
    ));
    
    if (!empty($children)) {
        wp_redirect(get_permalink($children[0]->ID), 301);
        exit;
    }
}
add_action('template_redirect', 'libro_redirect_parent_chapters');
```

### 2. Forzar meta `_numero_capitulo = '0'` para Prólogos (`sample-content.php`)

Añadir una función de reparación que se ejecute al activar el tema para asegurar que el capítulo "Prólogos" siempre tenga el meta `_numero_capitulo` con valor `'0'`, incluso si fue importado en una versión anterior:

```php
function libro_fix_prologos_numero() {
    $prologos = get_posts(array(
        'post_type' => 'capitulo',
        'title'     => 'Prólogos',
        'posts_per_page' => 1,
    ));
    if (!empty($prologos)) {
        $existing = get_post_meta($prologos[0]->ID, '_numero_capitulo', true);
        if (strlen($existing) === 0) {
            update_post_meta($prologos[0]->ID, '_numero_capitulo', '0');
        }
    }
}
add_action('after_switch_theme', 'libro_fix_prologos_numero');
```

### Archivos a modificar

| Archivo | Cambio |
|---------|--------|
| `wordpress-theme/functions.php` | Añadir hook `template_redirect` para redirigir capítulos padre al primer hijo |
| `wordpress-theme/inc/sample-content.php` | Añadir función `libro_fix_prologos_numero()` con hook `after_switch_theme` |

