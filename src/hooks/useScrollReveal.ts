import { useRef } from "react";
import { useInView } from "framer-motion";
import type { Variants } from "framer-motion";

export type RevealDirection = "up" | "down" | "left" | "right" | "none";

interface ScrollRevealOptions {
  direction?: RevealDirection;
  distance?: number;
  delay?: number;
  duration?: number;
  once?: boolean;
  amount?: number;
}

export function useScrollReveal({
  direction = "up",
  distance = 30,
  delay = 0,
  duration = 0.6,
  once = true,
  amount = 0.2,
}: ScrollRevealOptions = {}) {
  const ref = useRef(null);
  const isInView = useInView(ref, { once, amount });

  const getOffset = () => {
    switch (direction) {
      case "up": return { y: distance };
      case "down": return { y: -distance };
      case "left": return { x: distance };
      case "right": return { x: -distance };
      case "none": return {};
    }
  };

  const variants: Variants = {
    hidden: { opacity: 0, ...getOffset() },
    visible: {
      opacity: 1,
      x: 0,
      y: 0,
      transition: { duration, delay, ease: "easeOut" },
    },
  };

  return {
    ref,
    variants,
    initial: "hidden" as const,
    animate: isInView ? "visible" as const : "hidden" as const,
  };
}
