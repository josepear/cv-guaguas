import { Link } from "react-router-dom";
import { FileText, BookOpen, ChevronDown, ChevronRight } from "lucide-react";
import { cn } from "@/lib/utils";
import { useState, useEffect, forwardRef } from "react";

export interface ChapterItem {
  id: string;
  slug: string;
  title: string;
  number?: string;
  hideNumber?: boolean;
  children?: ChapterItem[];
}

interface SidebarIndexProps {
  chapters: ChapterItem[];
  activeChapterSlug?: string;
  isOpen: boolean;
  onClose: () => void;
}

const SidebarIndex = forwardRef<HTMLDivElement, SidebarIndexProps>(({ chapters, activeChapterSlug, isOpen, onClose }, ref) => {
  const [expandedGroups, setExpandedGroups] = useState<Set<string>>(new Set());

  const toggleGroup = (id: string) => {
    setExpandedGroups(prev => {
      const next = new Set(prev);
      if (next.has(id)) {
        next.delete(id);
      } else {
        next.add(id);
      }
      return next;
    });
  };

  const renderChapter = (chapter: ChapterItem, depth = 0) => {
    const isActive = activeChapterSlug === chapter.slug;
    const hasChildren = chapter.children && chapter.children.length > 0;
    const isExpanded = expandedGroups.has(chapter.id);
    const hasActiveChild = chapter.children?.some(c => c.slug === activeChapterSlug);

    return (
      <li key={chapter.id} className="relative">
        <div className="flex items-center">
          {hasChildren ? (
            <button
              onClick={() => toggleGroup(chapter.id)}
              className="w-6 flex-shrink-0 flex items-center justify-center text-muted-foreground hover:text-gold transition-colors"
            >
              {isExpanded || hasActiveChild ? (
                <ChevronDown className="w-4 h-4" />
              ) : (
                <ChevronRight className="w-4 h-4" />
              )}
            </button>
          ) : (
            <span className="w-6 flex-shrink-0" />
          )}
          
          {hasChildren ? (
            <button
              onClick={() => toggleGroup(chapter.id)}
              className={cn(
                "sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm cursor-pointer",
                "hover:bg-sidebar-accent hover:text-gold",
                depth === 0 ? "font-medium" : "font-normal",
                hasActiveChild && "text-gold/80"
              )}
            >
              <span className="flex items-center gap-2.5">
                {chapter.number && !chapter.hideNumber && (
                <span className={cn(
                    "flex items-center justify-center font-semibold font-sans rounded-sm transition-all duration-200 hover:scale-110",
                    depth === 0 
                      ? "min-w-[1.5rem] h-[1.5rem] text-[11px] bg-gold text-[hsl(220,50%,10%)] hover:shadow-[0_0_8px_hsl(45,100%,50%,0.5)]" 
                      : "min-w-[1.25rem] h-[1.25rem] text-[10px] bg-white text-[hsl(220,50%,10%)] hover:shadow-[0_0_6px_rgba(255,255,255,0.4)]"
                  )}>
                    {chapter.number}
                  </span>
                )}
                <span>{chapter.title}</span>
              </span>
            </button>
          ) : (
            <Link
              to={`/capitulo/${chapter.slug}`}
              onClick={onClose}
              className={cn(
                "sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm",
                "hover:bg-sidebar-accent hover:text-gold",
                depth === 0 ? "font-medium" : "font-normal",
                isActive && "active text-gold bg-sidebar-accent"
              )}
            >
              <span className="flex items-center gap-2.5">
                {chapter.number && !chapter.hideNumber && (
                <span className={cn(
                    "flex items-center justify-center font-semibold font-sans rounded-sm transition-all duration-200 hover:scale-110",
                    depth === 0 
                      ? "min-w-[1.5rem] h-[1.5rem] text-[11px] bg-gold text-[hsl(220,50%,10%)] hover:shadow-[0_0_8px_hsl(45,100%,50%,0.5)]" 
                      : "min-w-[1.25rem] h-[1.25rem] text-[10px] bg-white text-[hsl(220,50%,10%)] hover:shadow-[0_0_6px_rgba(255,255,255,0.4)]"
                  )}>
                    {chapter.number}
                  </span>
                )}
                <span className={cn(
                  depth > 0 && "text-sidebar-foreground/80",
                  isActive && "text-gold"
                )}>
                  {chapter.title}
                </span>
              </span>
            </Link>
          )}
        </div>
        
        {hasChildren && (isExpanded || hasActiveChild) && (
          <ul className="ml-4 mt-1 space-y-0.5 border-l border-sidebar-border pl-2">
            {chapter.children?.map(child => renderChapter(child as ChapterItem, depth + 1))}
          </ul>
        )}
      </li>
    );
  };

  return (
    <>
      {/* Overlay for mobile */}
      {isOpen && (
        <div 
          className="fixed inset-0 bg-background/80 backdrop-blur-sm z-40 top-[52px]"
          onClick={onClose}
        />
      )}

      {/* Sidebar */}
      <aside
        className={cn(
          "fixed left-0 top-[52px] h-[calc(100vh-52px)] z-40 bg-sidebar border-r border-sidebar-border",
          "w-full sm:w-[320px] flex flex-col",
          "transition-transform duration-300 ease-in-out",
          isOpen ? "translate-x-0" : "-translate-x-full"
        )}
      >
        {/* Chapters List */}
        <nav className="flex-1 overflow-y-auto p-4">
          <ul className="space-y-1">
            {chapters.map(chapter => renderChapter(chapter))}
          </ul>
        </nav>

        {/* Footer links */}
        <div className="p-4 pb-[calc(1rem+env(safe-area-inset-bottom)+20px)] border-t border-sidebar-border">
          <div className="flex gap-2">
            <a href="#" className="btn-download btn-download-outline flex-1 justify-center text-xs">
              <FileText className="w-3.5 h-3.5" />
              PDF
            </a>
            <a href="#" className="btn-download btn-download-outline flex-1 justify-center text-xs">
              <BookOpen className="w-3.5 h-3.5" />
              EPUB
            </a>
          </div>
        </div>
      </aside>
    </>
  );
});

SidebarIndex.displayName = "SidebarIndex";

export default SidebarIndex;
