import { useState } from "react";
import HeroSection from "@/components/HeroSection";
import Header from "@/components/Header";
import SidebarIndex from "@/components/SidebarIndex";
import InstitutionalFooter from "@/components/InstitutionalFooter";
import { ChapterItem } from "@/components/SidebarIndex";

// Chapter data for the sidebar - CV Guaguas book structure
const chapters: ChapterItem[] = [
  { 
    id: "capitulo-01", 
    slug: "capitulo-01",
    title: "Prólogos", 
    number: "01",
    children: [
      { id: "prologo-01", slug: "prologo-fernando-clavijo", title: "Fernando Clavijo", number: "1.1", hideNumber: true },
      { id: "prologo-02", slug: "prologo-antonio-morales", title: "Antonio Morales", number: "1.2", hideNumber: true },
      { id: "prologo-03", slug: "prologo-carolina-darias", title: "Carolina Darias", number: "1.3", hideNumber: true },
      { id: "prologo-04", slug: "prologo-poli-suarez", title: "Poli Suárez", number: "1.4", hideNumber: true },
      { id: "prologo-05", slug: "prologo-carla-campoamor", title: "Carla Campoamor", number: "1.5", hideNumber: true },
      { id: "prologo-06", slug: "prologo-felipe-pascual", title: "Felipe Pascual", number: "1.6", hideNumber: true },
      { id: "prologo-07", slug: "prologo-roberto-melian", title: "Roberto Melián", number: "1.7", hideNumber: true },
      { id: "prologo-08", slug: "prologo-eduardo-ramirez", title: "Eduardo Ramírez", number: "1.8", hideNumber: true },
      { id: "prologo-09", slug: "prologo-09", title: "Nombre, cargo", number: "1.9", hideNumber: true },
      { id: "prologo-10", slug: "prologo-10", title: "Nombre, cargo", number: "1.10", hideNumber: true },
    ]
  },
  { id: "capitulo-02", slug: "capitulo-02", title: "Del patio del colegio a la División de Honor", number: "02" },
  { id: "capitulo-03", slug: "capitulo-03", title: "Así se forjó una leyenda", number: "03" },
  { id: "capitulo-04", slug: "capitulo-04", title: "Una transición dolorosa", number: "04" },
  { id: "capitulo-05", slug: "capitulo-05", title: "Vuelve el gran Guaguas", number: "05" },
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
        chapters={chapters} 
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
