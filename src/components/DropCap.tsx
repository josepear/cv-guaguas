import { ReactNode } from "react";
import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";

interface DropCapProps { children: ReactNode; }

const DropCap = ({ children }: DropCapProps) => {
  const reveal = useScrollReveal({ direction: "none", duration: 0.8 });
  if (typeof children !== "string") return <p>{children}</p>;
  const firstLetter = children.charAt(0);
  const rest = children.slice(1);
  return (
    <motion.p ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate} className="drop-cap-paragraph">
      <span className="drop-cap">{firstLetter}</span>{rest}
    </motion.p>
  );
};

export default DropCap;
