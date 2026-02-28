import { Link } from "react-router-dom";
import { Home } from "lucide-react";
import {
  Breadcrumb,
  BreadcrumbList,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";
import { chaptersData } from "@/data/chaptersStructure";

interface ChapterBreadcrumbProps {
  chapterSlug: string;
  chapterTitle: string;
  chapterNumber?: string;
}

const ChapterBreadcrumb = ({ chapterSlug, chapterTitle, chapterNumber }: ChapterBreadcrumbProps) => {
  // Find parent chapter if current is a sub-chapter
  const parentChapter = chaptersData.find(ch =>
    ch.children?.some(child => child.slug === chapterSlug)
  );

  const currentLabel = chapterNumber 
    ? `${chapterNumber}. ${chapterTitle}` 
    : chapterTitle;

  return (
    <Breadcrumb className="mb-6">
      <BreadcrumbList className="text-xs">
        <BreadcrumbItem>
          <BreadcrumbLink asChild>
            <Link to="/" className="text-muted-foreground hover:text-gold transition-colors flex items-center gap-1">
              <Home className="w-3 h-3" />
              Inicio
            </Link>
          </BreadcrumbLink>
        </BreadcrumbItem>

        {parentChapter && (
          <>
            <BreadcrumbSeparator />
            <BreadcrumbItem>
              <BreadcrumbLink asChild>
                <Link 
                  to={`/capitulo/${parentChapter.slug}`} 
                  className="text-muted-foreground hover:text-gold transition-colors"
                >
                  {parentChapter.number ? `${parentChapter.number}. ${parentChapter.title}` : parentChapter.title}
                </Link>
              </BreadcrumbLink>
            </BreadcrumbItem>
          </>
        )}

        <BreadcrumbSeparator />
        <BreadcrumbItem>
          <BreadcrumbPage className="text-foreground/70 font-normal">
            {currentLabel}
          </BreadcrumbPage>
        </BreadcrumbItem>
      </BreadcrumbList>
    </Breadcrumb>
  );
};

export default ChapterBreadcrumb;
