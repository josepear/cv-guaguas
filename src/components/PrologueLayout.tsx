import { ReactNode } from "react";
import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";

interface PrologueLayoutProps {
  name: string;
  role: string;
  imageSrc?: string;
  imageAlt?: string;
  objectPosition?: string;
  imageScale?: number;
  children: ReactNode;
}

const PrologueLayout = ({ name, role, imageSrc, imageAlt, objectPosition = "center 20%", imageScale = 1, children }: PrologueLayoutProps) => {
  const reveal = useScrollReveal({ direction: "up", distance: 40, duration: 0.7 });

  return (
    <motion.div
      ref={reveal.ref}
      variants={reveal.variants}
      initial={reveal.initial}
      animate={reveal.animate}
      className="prologue-layout"
    >
      {/* Centered photo with rounded corners */}
      <div className="flex justify-center mb-8">
        {imageSrc ? (
          <div className="w-32 h-32 md:w-40 md:h-40 rounded-[2rem] overflow-hidden shadow-lg border border-border/50">
            <img
              src={imageSrc}
              alt={imageAlt || name}
              className="w-full h-full object-cover"
              style={{ objectPosition, transform: `scale(${imageScale})` }}
              loading="lazy"
            />
          </div>
        ) : (
          <div className="w-32 h-32 md:w-40 md:h-40 rounded-3xl bg-muted flex items-center justify-center">
            <span className="font-serif text-4xl font-bold text-muted-foreground">
              {name.split(" ").map(w => w[0]).join("")}
            </span>
          </div>
        )}
      </div>

      {/* Name with highlighted background - gold in dark, navy in light */}
      <div className="text-center mb-2">
        <h3 className="prologue-name-highlight inline font-serif text-lg md:text-xl font-black uppercase tracking-wide px-3 py-1 leading-relaxed"
          style={{ boxDecorationBreak: "clone", WebkitBoxDecorationBreak: "clone" }}
        >
          {name}
        </h3>
      </div>

      {/* Role subtitle */}
      <p className="text-center text-xs md:text-sm font-sans font-semibold uppercase tracking-[0.15em] text-muted-foreground mb-10">
        {role}
      </p>

      {/* Prologue content */}
      <div className="reading-content text-foreground/85">
        {children}
      </div>
    </motion.div>
  );
};

export default PrologueLayout;
