import logoCabildo from "@/assets/sponsors/cabildo-gran-canaria.png";
import logoInstitutoInsular from "@/assets/sponsors/instituto-insular-deportes.png";
import logoGobCan from "@/assets/sponsors/gobierno-canarias.png";
import logoAyto from "@/assets/sponsors/ayuntamiento-las-palmas.png";
import logoIMD from "@/assets/sponsors/instituto-municipal-deportes.png";
import logoTurismo from "@/assets/sponsors/turismo-gran-canaria.png";
import logoIslasCanarias from "@/assets/sponsors/islas-canarias.png";
import logoRFEVB from "@/assets/sponsors/rfevb.png";

interface InstitutionalFooterProps {
  logos?: { src: string; alt: string; url?: string }[];
  copyrightText?: string;
}

const defaultLogos = [
  { src: logoCabildo, alt: "Cabildo de Gran Canaria", url: "https://www.grancanaria.com" },
  { src: logoInstitutoInsular, alt: "Instituto Insular de Deportes", url: "https://www.grancanaria.com" },
  { src: logoGobCan, alt: "Gobierno de Canarias", url: "https://www.gobiernodecanarias.org" },
  { src: logoIslasCanarias, alt: "Islas Canarias", url: "https://www.islascanarias.org" },
  { src: logoAyto, alt: "Ayuntamiento de Las Palmas de Gran Canaria", url: "https://www.laspalmasgc.es" },
  { src: logoIMD, alt: "Instituto Municipal de Deportes", url: "https://www.laspalmasgc.es" },
  { src: logoTurismo, alt: "Turismo de Gran Canaria", url: "https://www.grancanaria.com" },
  { src: logoRFEVB, alt: "Real Federación Española de Voleibol", url: "https://www.rfevb.com" },
];

const InstitutionalFooter = ({ 
  logos,
  copyrightText = `© ${new Date().getFullYear()} Club Voleibol Guaguas. Todos los derechos reservados.`
}: InstitutionalFooterProps) => {
  const displayLogos = logos && logos.length > 0 ? logos : defaultLogos;

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
                    className="h-8 md:h-10 lg:h-12 w-auto object-contain transition-all duration-500 grayscale opacity-40 group-hover:opacity-80 dark:invert dark:group-hover:opacity-90"
                    loading="lazy"
                  />
                ) : (
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
