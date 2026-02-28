interface TimelineEventProps {
  year: string;
  children: React.ReactNode;
}

const TimelineEvent = ({ year, children }: TimelineEventProps) => {
  return (
    <div className="timeline-event">
      <span className="timeline-year">{year}</span>
      <div className="timeline-content">{children}</div>
    </div>
  );
};

interface TimelineProps {
  children: React.ReactNode;
  title?: string;
}

const Timeline = ({ children, title }: TimelineProps) => {
  return (
    <div className="timeline-container my-12">
      {title && (
        <h3 className="section-header-highlighted mb-8">{title}</h3>
      )}
      <div className="timeline-list">
        {children}
      </div>
    </div>
  );
};

export { Timeline, TimelineEvent };
export default Timeline;
