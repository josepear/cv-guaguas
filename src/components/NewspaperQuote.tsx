import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";

interface NewspaperQuoteProps { children: React.ReactNode; source?: string; }

const NewspaperQuote = ({ children, source }: NewspaperQuoteProps) => {
  const reveal = useScrollReveal({ direction: "left", distance: 20, duration: 0.5 });
  return (
    <motion.div ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate}>
      <blockquote className="newspaper-quote">
        <p>{children}</p>
        {source && <cite className="newspaper-quote-source">{source}</cite>}
      </blockquote>
    </motion.div>
  );
};

export default NewspaperQuote;
