import { useState } from "react";
import HeroSection from "@/components/HeroSection";
import Header from "@/components/Header";
import SidebarIndex from "@/components/SidebarIndex";
import InstitutionalFooter from "@/components/InstitutionalFooter";
import { chaptersData } from "@/data/chaptersStructure";

import logoCabildo from "@/assets/sponsors/cabildo-gran-canaria.png";
import logoInstitutoInsular from "@/assets/sponsors/instituto-insular-deportes.png";
import logoGobCan from "@/assets/sponsors/gobierno-canarias.png";
import logoAyto from "@/assets/sponsors/ayuntamiento-las-palmas.png";
import logoIMD from "@/assets/sponsors/instituto-municipal-deportes.png";
import logoTurismo from "@/assets/sponsors/turismo-gran-canaria.png";
import logoIslasCanarias from "@/assets/sponsors/islas-canarias.png";
import logoRFEVB from "@/assets/sponsors/rfevb.png";

const sponsorLogos = [
  { src: logoCabildo, alt: "Cabildo de Gran Canaria", url: "https://www.grancanaria.com" },
  { src: logoInstitutoInsular, alt: "Instituto Insular de Deportes", url: "https://www.grancanaria.com" },
  { src: logoGobCan, alt: "Gobierno de Canarias", url: "https://www.gobiernodecanarias.org" },
  { src: logoIslasCanarias, alt: "Islas Canarias", url: "https://www.islascanarias.org" },
  { src: logoAyto, alt: "Ayuntamiento de Las Palmas de Gran Canaria", url: "https://www.laspalmasgc.es" },
  { src: logoIMD, alt: "Instituto Municipal de Deportes", url: "https://www.laspalmasgc.es" },
  { src: logoTurismo, alt: "Turismo de Gran Canaria", url: "https://www.grancanaria.com" },
  { src: logoRFEVB, alt: "Real Federación Española de Voleibol", url: "https://www.rfevb.com" },
];

const Index = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <div className="min-h-screen bg-background">
      <Header 
        onMenuToggle={() => setIsMenuOpen(!isMenuOpen)} 
        isMenuOpen={isMenuOpen} 
      />
      
      <SidebarIndex 
        chapters={chaptersData} 
        isOpen={isMenuOpen}
        onClose={() => setIsMenuOpen(false)}
      />

      <main className="pt-[52px]">
        <HeroSection 
          title="Historia del CV Guaguas"
          subtitle="Un recorrido por la trayectoria del club que ha conquistado el voleibol español"
        />
        
        <InstitutionalFooter logos={sponsorLogos} />
      </main>
    </div>
  );
};

export default Index;
