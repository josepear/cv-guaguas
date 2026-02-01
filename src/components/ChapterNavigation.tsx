import { Link } from "react-router-dom";
import { ChevronLeft, ChevronRight } from "lucide-react";

interface ChapterInfo {
  slug: string;
  title: string;
  number?: string;
}

interface ChapterNavigationProps {
  previousChapter?: ChapterInfo | null;
  nextChapter?: ChapterInfo | null;
}

const ChapterNavigation = ({ previousChapter, nextChapter }: ChapterNavigationProps) => {
  return (
    <nav className="mt-16 pt-8">
      <div className="flex flex-col sm:flex-row items-stretch gap-4">
        {/* Previous Chapter */}
        {previousChapter ? (
          <Link
            to={`/capitulo/${previousChapter.slug}`}
            className="flex-1 group flex items-center gap-4 p-4 rounded border border-border/50 bg-card/30 hover:border-gold/50 hover:bg-card/50 transition-all duration-300"
          >
            <ChevronLeft className="w-5 h-5 text-muted-foreground group-hover:text-gold transition-colors" />
            <div className="text-left">
              <span className="text-xs uppercase tracking-wider text-muted-foreground block mb-1">
                Anterior
              </span>
              <span className="font-serif text-foreground group-hover:text-gold transition-colors">
                {previousChapter.number && (
                  <span className="text-gold-muted mr-2">{previousChapter.number}</span>
                )}
                {previousChapter.title}
              </span>
            </div>
          </Link>
        ) : (
          <div className="flex-1" />
        )}

        {/* Next Chapter */}
        {nextChapter ? (
          <Link
            to={`/capitulo/${nextChapter.slug}`}
            className="flex-1 group flex items-center justify-end gap-4 p-4 rounded border border-border/50 bg-card/30 hover:border-gold/50 hover:bg-card/50 transition-all duration-300"
          >
            <div className="text-right">
              <span className="text-xs uppercase tracking-wider text-muted-foreground block mb-1">
                Siguiente
              </span>
              <span className="font-serif text-foreground group-hover:text-gold transition-colors">
                {nextChapter.number && (
                  <span className="text-gold-muted mr-2">{nextChapter.number}</span>
                )}
                {nextChapter.title}
              </span>
            </div>
            <ChevronRight className="w-5 h-5 text-muted-foreground group-hover:text-gold transition-colors" />
          </Link>
        ) : (
          <div className="flex-1" />
        )}
      </div>
    </nav>
  );
};

export default ChapterNavigation;
