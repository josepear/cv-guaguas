import { useState } from "react";
import HeroSection from "@/components/HeroSection";
import Header from "@/components/Header";
import SidebarIndex from "@/components/SidebarIndex";
import InstitutionalFooter from "@/components/InstitutionalFooter";

// Chapter data for the sidebar
const chapters = [
  { id: "prologo", slug: "prologo", title: "Prólogo", number: "" },
  { id: "introduccion", slug: "introduccion", title: "Introducción", number: "" },
  { id: "capitulo-01", slug: "capitulo-01", title: "Los Orígenes", number: "01" },
  { id: "capitulo-02", slug: "capitulo-02", title: "Construcción del Recinto", number: "02" },
  { id: "capitulo-03", slug: "capitulo-03", title: "La Inauguración", number: "03" },
  { id: "capitulo-04", slug: "capitulo-04", title: "Primeros Eventos", number: "04" },
  { id: "capitulo-05", slug: "capitulo-05", title: "Década de Consolidación", number: "05" },
  { id: "capitulo-06", slug: "capitulo-06", title: "Expansiones y Mejoras", number: "06" },
  { id: "capitulo-07", slug: "capitulo-07", title: "Momentos Históricos", number: "07" },
  { id: "capitulo-08", slug: "capitulo-08", title: "El Estadio y la Ciudad", number: "08" },
  { id: "capitulo-09", slug: "capitulo-09", title: "Modernización", number: "09" },
  { id: "capitulo-10", slug: "capitulo-10", title: "Sostenibilidad", number: "10" },
  { id: "capitulo-11", slug: "capitulo-11", title: "Eventos Memorables", number: "11" },
  { id: "capitulo-12", slug: "capitulo-12", title: "Figuras Destacadas", number: "12" },
  { id: "capitulo-13", slug: "capitulo-13", title: "El Futuro", number: "13" },
  { id: "epilogo", slug: "epilogo", title: "Epílogo", number: "" },
  { id: "agradecimientos", slug: "agradecimientos", title: "Agradecimientos", number: "" },
  { id: "bibliografia", slug: "bibliografia", title: "Bibliografía", number: "" },
  { id: "creditos", slug: "creditos", title: "Créditos", number: "" },
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
          title="Historia del Estadio"
          subtitle="Un recorrido por la arquitectura y los momentos que definieron una era deportiva en nuestra ciudad"
        />
        
        <InstitutionalFooter 
          copyrightText="© 2024 Fundación Estadio Histórico. Todos los derechos reservados."
        />
      </main>
    </div>
  );
};

export default Index;
