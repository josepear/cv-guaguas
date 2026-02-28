import { useState } from "react";
import HeroSection from "@/components/HeroSection";
import Header from "@/components/Header";
import SidebarIndex from "@/components/SidebarIndex";
import InstitutionalFooter from "@/components/InstitutionalFooter";
import { chaptersData } from "@/data/chaptersStructure";

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
        
        <InstitutionalFooter />
      </main>
    </div>
  );
};

export default Index;
