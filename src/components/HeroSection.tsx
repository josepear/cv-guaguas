import { ArrowRight, FileText, BookOpen } from "lucide-react";
import { Link } from "react-router-dom";
import heroImage from "@/assets/hero-stadium.jpg";

interface HeroSectionProps {
  title: string;
  subtitle?: string;
}

const HeroSection = ({ 
  title = "Historia del Estadio",
  subtitle = "Un recorrido por la arquitectura y los momentos que definieron una era"
}: HeroSectionProps) => {
  return (
    <section 
      id="hero" 
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
    >
      {/* Background Image */}
      <div 
        className="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style={{ backgroundImage: `url(${heroImage})` }}
      />
      
      {/* Overlay */}
      <div className="hero-overlay absolute inset-0" />
      
      {/* Content */}
      <div className="relative z-10 text-center px-6 max-w-4xl mx-auto">
        {/* Institution marker */}
        <span className="chapter-marker inline-block mb-6 opacity-0 animate-fade-in-up">
          Libro Institucional
        </span>
        
        {/* Main Title */}
        <h1 className="font-serif text-4xl md:text-5xl lg:text-7xl text-foreground mb-6 opacity-0 animate-fade-in-up [animation-delay:200ms]">
          <span className="text-gold-gradient">{title}</span>
        </h1>
        
        {/* Subtitle */}
        {subtitle && (
          <p className="font-sans text-lg md:text-xl text-foreground/80 max-w-2xl mx-auto mb-12 opacity-0 animate-fade-in-up [animation-delay:400ms]">
            {subtitle}
          </p>
        )}
        
        {/* Download buttons */}
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 opacity-0 animate-fade-in-up [animation-delay:600ms]">
          <a href="#" className="btn-download btn-download-primary">
            <FileText className="w-4 h-4" />
            Descargar PDF
          </a>
          <a href="#" className="btn-download btn-download-outline">
            <BookOpen className="w-4 h-4" />
            Descargar EPUB
          </a>
        </div>
        
        {/* CTA to start reading */}
        <Link
          to="/capitulo/prologo"
          className="inline-flex items-center gap-2 text-gold hover:text-gold-light transition-colors duration-300 opacity-0 animate-fade-in-up [animation-delay:800ms] group"
        >
          <span className="text-sm uppercase tracking-widest font-sans">
            Comenzar a leer
          </span>
          <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
        </Link>
      </div>
      
      {/* Bottom gradient fade */}
      <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent" />
    </section>
  );
};

export default HeroSection;
