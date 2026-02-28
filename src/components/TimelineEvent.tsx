import { motion } from "framer-motion";
import { useScrollReveal } from "@/hooks/useScrollReveal";

interface TimelineEventProps { year: string; children: React.ReactNode; }

const TimelineEvent = ({ year, children }: TimelineEventProps) => {
  const reveal = useScrollReveal({ direction: "left", distance: 20, duration: 0.4 });
  return (
    <motion.div ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate} className="timeline-event">
      <span className="timeline-year">{year}</span>
      <div className="timeline-content">{children}</div>
    </motion.div>
  );
};

interface TimelineProps { children: React.ReactNode; title?: string; }

const Timeline = ({ children, title }: TimelineProps) => {
  const reveal = useScrollReveal({ direction: "up", distance: 30, duration: 0.5 });
  return (
    <motion.div ref={reveal.ref} variants={reveal.variants} initial={reveal.initial} animate={reveal.animate} className="timeline-container my-12">
      {title && <h3 className="section-header-highlighted mb-8">{title}</h3>}
      <div className="timeline-list">{children}</div>
    </motion.div>
  );
};

export { Timeline, TimelineEvent };
export default Timeline;
