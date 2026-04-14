import { ReactNode } from "react";
import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";
import { Star } from "lucide-react";

interface FichaDebutProps {
  titulo: string;
  parciales: string;
  arbitros?: string;
  incidencias?: string;
  children: ReactNode;
}

const FichaDebut = ({ titulo, parciales, arbitros, incidencias, children }: FichaDebutProps) => {
  const reveal = useScrollReveal({ direction: "none", duration: 0.6 });
  return (
    <motion.div
      ref={reveal.ref}
      variants={reveal.variants}
      initial={reveal.initial}
      animate={reveal.animate}
      className="bg-muted/50 border border-border rounded-lg p-5 md:p-6 my-6"
    >
      <div className="flex items-center justify-center gap-2 mb-4">
        <Star className="w-4 h-4 text-primary" />
        <h4 className="text-sm font-bold uppercase tracking-widest text-foreground">{titulo}</h4>
        <Star className="w-4 h-4 text-primary" />
      </div>
      <div className="divide-y divide-border">
        {children}
      </div>
      <hr className="my-4 border-border" />
      <div className="space-y-2 text-sm text-muted-foreground">
        <p><strong className="text-foreground">Parciales:</strong> {parciales}</p>
        {arbitros && <p><strong className="text-foreground">Árbitros:</strong> {arbitros}</p>}
        {incidencias && <p><strong className="text-foreground">Incidencias:</strong> {incidencias}</p>}
      </div>
    </motion.div>
  );
};

export default FichaDebut;
