import { forwardRef } from "react";
import { ArrowRight, FileText, BookOpen } from "lucide-react";
import { Link } from "react-router-dom";
import heroImage from "@/assets/hero-home.jpg";
import logoGuaguas from "@/assets/logo-guaguas.svg";

interface HeroSectionProps {
  title: string;
  subtitle?: string;
}

const HeroSection = forwardRef<HTMLElement, HeroSectionProps>(({ 
  title = "50 Años de Historia",
  subtitle = "Cinco décadas de pasión, títulos y leyendas del voleibol canario"
}, ref) => {
  return (
    <section 
      ref={ref}
      id="hero"
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
    >
      {/* Background Image */}
      <img 
        src={heroImage}
        alt=""
        fetchPriority="high"
        decoding="async"
        className="absolute inset-0 w-full h-full object-cover object-center"
      />
      
      {/* Overlay */}
      <div className="hero-overlay absolute inset-0" />
      
      {/* Content */}
      <div className="relative z-10 text-center px-6 max-w-4xl mx-auto">
        {/* Logo */}
        <div className="mb-8 opacity-0 animate-fade-in-up">
          <img 
            src={logoGuaguas} 
            alt="CV Guaguas" 
            width={160}
            height={160}
            className="h-32 md:h-40 w-auto mx-auto drop-shadow-2xl"
          />
        </div>
        
        {/* Anniversary marker */}
        <span className="chapter-marker inline-block mb-6 opacity-0 animate-fade-in-up [animation-delay:100ms]">
          50 Aniversario · 1976 - 2026
        </span>
        
        {/* Main Title */}
        <h1 className="font-serif font-bold text-4xl md:text-5xl lg:text-7xl text-white mb-6 opacity-0 animate-fade-in-up [animation-delay:200ms]">
          <span className="text-gold-gradient">{title}</span>
        </h1>
        
        {/* Subtitle */}
        {subtitle && (
          <p className="font-sans text-lg md:text-xl text-white/80 max-w-2xl mx-auto mb-12 opacity-0 animate-fade-in-up [animation-delay:400ms]">
            {subtitle}
          </p>
        )}
        
        {/* Download buttons */}
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 opacity-0 animate-fade-in-up [animation-delay:600ms]">
          <a href="#" className="btn-download btn-download-primary !bg-gold !text-[hsl(220,50%,10%)] !border-gold hover:!bg-transparent hover:!text-gold">
            <FileText className="w-4 h-4" />
            Descargar PDF
          </a>
          <a href="#" className="btn-download !bg-transparent !text-white !border-white/30 hover:!border-gold hover:!text-gold">
            <BookOpen className="w-4 h-4" />
            Descargar EPUB
          </a>
        </div>
        
        {/* CTA to start reading */}
        <Link
          to="/capitulo/prologo-fernando-clavijo"
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
});

HeroSection.displayName = "HeroSection";

export default HeroSection;
