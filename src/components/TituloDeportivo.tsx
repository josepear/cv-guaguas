import { ReactNode } from "react";
import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";
import { Trophy } from "lucide-react";

interface EquipoProps {
  nombre: string;
  sets: number;
  children: ReactNode;
}

const Equipo = ({ nombre, sets, children }: EquipoProps) => (
  <div className="flex items-start gap-3 py-3">
    <span className="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 text-primary font-bold text-sm flex-shrink-0 mt-0.5">
      {sets}
    </span>
    <div>
      <p className="font-bold text-foreground uppercase tracking-wide text-sm">{nombre}</p>
      <p className="text-muted-foreground text-sm mt-1 leading-relaxed">{children}</p>
    </div>
  </div>
);

interface FichaTecnicaProps {
  parciales: string;
  arbitros?: string;
  incidencias?: string;
  children: ReactNode;
}

const FichaTecnica = ({ parciales, arbitros, incidencias, children }: FichaTecnicaProps) => {
  const reveal = useScrollReveal({ direction: "none", duration: 0.6 });
  return (
    <motion.div
      ref={reveal.ref}
      variants={reveal.variants}
      initial={reveal.initial}
      animate={reveal.animate}
      className="bg-muted/50 border border-border rounded-lg p-5 md:p-6 my-6"
    >
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

interface TituloDeportivoProps {
  numero: number;
  nombre: string;
  anio: string;
  children: ReactNode;
}

const TituloDeportivo = ({ numero, nombre, anio, children }: TituloDeportivoProps) => {
  const reveal = useScrollReveal({ direction: "up", distance: 20, duration: 0.7 });
  return (
    <motion.div
      ref={reveal.ref}
      variants={reveal.variants}
      initial={reveal.initial}
      animate={reveal.animate}
    >
      <div className="flex items-center gap-3 mb-6">
        <div className="flex items-center justify-center w-10 h-10 rounded-full bg-primary/10">
          <Trophy className="w-5 h-5 text-primary" />
        </div>
        <div>
          <span className="text-xs font-mono text-muted-foreground uppercase tracking-widest">Título nº {numero}</span>
          <h3 className="font-serif text-xl md:text-2xl font-bold text-foreground leading-tight">
            {nombre} <span className="text-primary">{anio}</span>
          </h3>
        </div>
      </div>
      {children}
    </motion.div>
  );
};

interface NarrativaProps {
  children: ReactNode;
}

const Narrativa = ({ children }: NarrativaProps) => {
  const reveal = useScrollReveal({ direction: "none", duration: 0.8 });
  return (
    <motion.div
      ref={reveal.ref}
      variants={reveal.variants}
      initial={reveal.initial}
      animate={reveal.animate}
      className="mt-6 prose prose-lg max-w-none text-foreground/90 leading-relaxed"
    >
      {children}
    </motion.div>
  );
};

export { TituloDeportivo, FichaTecnica, Equipo, Narrativa };
export default TituloDeportivo;
