import { useParams, Navigate } from "react-router-dom";
import { useState, useMemo, useEffect } from "react";
import SidebarIndex from "@/components/SidebarIndex";
import Header from "@/components/Header";
import ChapterSection from "@/components/ChapterSection";
import ChapterNavigation from "@/components/ChapterNavigation";
import ReadingProgressBar from "@/components/ReadingProgressBar";
import ChapterHero from "@/components/ChapterHero";
import InstitutionalFooter from "@/components/InstitutionalFooter";
import ChapterBreadcrumb from "@/components/ChapterBreadcrumb";
import PrologueLayout from "@/components/PrologueLayout";
import { chaptersData, getAllChapters, getChapterBySlug } from "@/data/chaptersStructure";
import { chapterContent } from "@/data/chapterContent";
import { sponsorLogos } from "@/data/sponsorLogos";

const Chapter = () => {
  const { slug } = useParams<{ slug: string }>();
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  
  const allChapters = useMemo(() => getAllChapters(), []);
  
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [slug]);
  
  if (!slug) {
    return <Navigate to="/" replace />;
  }

  const chapter = getChapterBySlug(slug);
  
  if (!chapter) {
    return <Navigate to="/" replace />;
  }

  // Parent chapters with children redirect to first child
  if (chapter.children && chapter.children.length > 0) {
    return <Navigate to={`/capitulo/${chapter.children[0].slug}`} replace />;
  }

  const content = chapterContent[slug];
  
  const currentIndex = allChapters.findIndex(ch => ch.slug === slug);
  const previousChapter = currentIndex > 0 ? allChapters[currentIndex - 1] : null;
  const nextChapter = currentIndex < allChapters.length - 1 ? allChapters[currentIndex + 1] : null;

  return (
    <div className="min-h-screen bg-background">
      <Header 
        onMenuToggle={() => setIsMenuOpen(!isMenuOpen)} 
        isMenuOpen={isMenuOpen} 
      />

      <ReadingProgressBar />

      <SidebarIndex 
        chapters={chaptersData} 
        activeChapterSlug={slug}
        isOpen={isMenuOpen}
        onClose={() => setIsMenuOpen(false)}
      />

      <main className="pt-[52px] min-h-screen">
        {chapter.hero && (
          <ChapterHero
            backgroundImage={chapter.hero.backgroundImage}
            backgroundOverlay={chapter.hero.backgroundOverlay}
            icon={chapter.hero.icon}
            customIconSrc={chapter.hero.customIconSrc}
            customIconColor={chapter.hero.customIconColor}
            iconColor={chapter.hero.iconColor}
            iconSize={chapter.hero.iconSize}
            iconWidth={chapter.hero.iconWidth}
            iconHeight={chapter.hero.iconHeight}
            alignment={chapter.hero.alignment}
            verticalPosition={chapter.hero.verticalPosition}
            borderColor={chapter.hero.borderColor}
            titleLines={chapter.hero.titleLines}
            titleFontWeight={chapter.hero.titleFontWeight}
            height={chapter.hero.height}
            minHeight={chapter.hero.minHeight}
            aspectRatio={chapter.hero.aspectRatio}
            backgroundPosition={chapter.hero.backgroundPosition}
          />
        )}
        
        <div className="max-w-4xl mx-auto px-6 md:px-12 lg:px-16 py-16">
          <ChapterBreadcrumb 
            chapterSlug={slug}
            chapterTitle={chapter.title}
            chapterNumber={chapter.number}
          />
          <ChapterSection 
            id={chapter.id} 
            number={chapter.number} 
            title={chapter.title}
            showChapterMarker={!chapter.hero && !!chapter.number && !chapter.isPrologue}
            showTitle={!chapter.hero && !chapter.isPrologue}
          >
            {chapter.isPrologue ? (
              <PrologueLayout
                name={chapter.title}
                role={chapter.subtitle || ""}
                imageSrc={chapter.prologueImage}
                objectPosition={chapter.prologueImagePosition}
                imageScale={chapter.prologueImageScale}
              >
                {content || <p>Texto del prólogo pendiente de redacción.</p>}
              </PrologueLayout>
            ) : (
              content || <p>Contenido del capítulo próximamente.</p>
            )}
          </ChapterSection>

          <ChapterNavigation 
            previousChapter={previousChapter}
            nextChapter={nextChapter}
          />
        </div>
      </main>

      <InstitutionalFooter logos={sponsorLogos} />
    </div>
  );
};

export default Chapter;
