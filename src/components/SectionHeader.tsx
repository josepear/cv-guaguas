import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";

interface SectionHeaderProps { children: React.ReactNode; highlighted?: boolean; className?: string; }

const SectionHeader = ({ children, highlighted = true, className = "" }: SectionHeaderProps) => {
  const reveal = useScrollReveal({ direction: "left", distance: 25, duration: 0.5 });

  if (highlighted) {
    return (
      <motion.div ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate} className="mt-10 mb-5">
        <h3 className={`section-header-highlighted ${className}`}>{children}</h3>
      </motion.div>
    );
  }
  return (
    <motion.h3 ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate} className={`font-serif text-xl md:text-2xl font-bold text-foreground mt-12 mb-6 uppercase tracking-wide ${className}`}>
      {children}
    </motion.h3>
  );
};

export default SectionHeader;
