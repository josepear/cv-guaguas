import { ReactNode } from "react";

interface ChapterSectionProps {
  id: string;
  number?: string;
  title: string;
  children: ReactNode;
  showChapterMarker?: boolean;
  showTitle?: boolean;
}

const ChapterSection = ({ 
  id, 
  number, 
  title, 
  children,
  showChapterMarker = true,
  showTitle = true,
}: ChapterSectionProps) => {
  return (
    <section 
      id={id}
      className="scroll-mt-24 py-16 md:py-24 border-b border-border/30 last:border-b-0"
    >
      {(showTitle || (showChapterMarker && number)) && (
        <header className="mb-8 md:mb-12">
          {showChapterMarker && number && (
            <span className="chapter-marker block mb-4">
              Capítulo {number}
            </span>
          )}
          {showTitle && (
            <h2 className="font-serif text-3xl md:text-4xl lg:text-5xl text-foreground leading-tight">
              {title}
            </h2>
          )}
        </header>
      )}
      
      <div className="reading-content text-foreground/85">
        {children}
      </div>
    </section>
  );
};

export default ChapterSection;
