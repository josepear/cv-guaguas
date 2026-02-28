import { ReactNode } from "react";
import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";

interface EditorialQuoteProps { children: ReactNode; author?: string; source?: string; }

const EditorialQuote = ({ children, author, source }: EditorialQuoteProps) => {
  const reveal = useScrollReveal({ direction: "left", distance: 30, duration: 0.7 });
  return (
    <motion.div ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate}>
      <blockquote className="editorial-quote my-8 md:my-12 py-4">
        <p className="text-xl md:text-2xl text-foreground/90 leading-relaxed mb-4">{children}</p>
        {(author || source) && (
          <footer className="text-sm text-muted-foreground">
            {author && <cite className="not-italic font-medium">{author}</cite>}
            {source && <span className="ml-2">— {source}</span>}
          </footer>
        )}
      </blockquote>
    </motion.div>
  );
};

export default EditorialQuote;
