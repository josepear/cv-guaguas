interface InstitutionalFooterProps {
  logos?: { src: string; alt: string; url?: string }[];
  copyrightText?: string;
}

const InstitutionalFooter = ({ 
  logos = [],
  copyrightText = "© 2024 Todos los derechos reservados"
}: InstitutionalFooterProps) => {
  // Default placeholder logos if none provided
  const defaultLogos = [
    { alt: "Gobierno Regional", src: "", url: "#" },
    { alt: "Cabildo Insular", src: "", url: "#" },
    { alt: "Instituto Deportivo", src: "", url: "#" },
    { alt: "Ayuntamiento", src: "", url: "#" },
    { alt: "Universidad", src: "", url: "#" },
    { alt: "Fundación", src: "", url: "#" },
  ];

  const displayLogos = logos.length > 0 ? logos : defaultLogos;

  return (
    <footer className="bg-sidebar border-t border-sidebar-border">
      {/* Logos Section */}
      <div className="py-12 md:py-16 border-b border-sidebar-border">
        <div className="container mx-auto px-6">
          <p className="text-center text-xs uppercase tracking-widest text-muted-foreground mb-8">
            Con el apoyo de
          </p>
          
          <div className="flex flex-wrap items-center justify-center gap-6 md:gap-10 lg:gap-14">
            {displayLogos.map((logo, index) => (
              <a
                key={index}
                href={logo.url || "#"}
                className="group flex items-center justify-center p-2 transition-opacity duration-300 hover:opacity-80"
                target="_blank"
                rel="noopener noreferrer"
              >
                {logo.src ? (
                  <img 
                    src={logo.src} 
                    alt={logo.alt}
                    className="h-8 md:h-10 lg:h-12 w-auto object-contain filter brightness-75 group-hover:brightness-100 transition-all duration-300"
                    loading="lazy"
                  />
                ) : (
                  // Placeholder logo
                  <div className="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                    {logo.alt}
                  </div>
                )}
              </a>
            ))}
          </div>
        </div>
      </div>

      {/* Copyright Section */}
      <div className="py-6">
        <div className="container mx-auto px-6">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
            <p>{copyrightText}</p>
            
            <nav className="flex items-center gap-6">
              <a href="#" className="hover:text-gold transition-colors">
                Aviso Legal
              </a>
              <a href="#" className="hover:text-gold transition-colors">
                Privacidad
              </a>
              <a href="#" className="hover:text-gold transition-colors">
                Accesibilidad
              </a>
            </nav>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default InstitutionalFooter;
