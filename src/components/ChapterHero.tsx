import { ReactNode } from "react";
import { Star } from "lucide-react";

export interface TitleLine {
  text: string;
  color?: string; // CSS color value
  highlightColor?: string; // Background highlight color
}

export interface ChapterHeroProps {
  backgroundImage?: string;
  backgroundOverlay?: string; // Overlay color with opacity (e.g., "rgba(0,0,0,0.5)" or "hsl(45 100% 50% / 0.8)")
  icon?: "star" | "star-outline" | "none" | ReactNode;
  iconColor?: string;
  iconSize?: "sm" | "md" | "lg";
  titleLines: TitleLine[];
  alignment?: "left" | "center" | "right";
  verticalPosition?: "top" | "center" | "bottom";
  className?: string;
  aspectRatio?: "16/9" | "4/3" | "3/2" | "1/1" | "auto";
  minHeight?: string;
  borderColor?: string; // For decorative border like in example 1
}

const ChapterHero = ({
  backgroundImage,
  backgroundOverlay,
  icon = "star",
  iconColor = "hsl(var(--gold))",
  iconSize = "md",
  titleLines,
  alignment = "center",
  verticalPosition = "center",
  className = "",
  aspectRatio = "auto",
  minHeight = "400px",
  borderColor,
}: ChapterHeroProps) => {
  
  // Icon size mapping
  const iconSizes = {
    sm: "w-8 h-8",
    md: "w-12 h-12",
    lg: "w-16 h-16",
  };

  // Alignment classes
  const alignmentClasses = {
    left: "items-start text-left",
    center: "items-center text-center",
    right: "items-end text-right",
  };

  // Vertical position classes
  const verticalClasses = {
    top: "justify-start pt-16",
    center: "justify-center",
    bottom: "justify-end pb-16",
  };

  // Render icon
  const renderIcon = () => {
    if (icon === "none") return null;
    
    if (icon === "star") {
      return (
        <Star 
          className={`${iconSizes[iconSize]} fill-current`} 
          style={{ color: iconColor }}
        />
      );
    }
    
    if (icon === "star-outline") {
      return (
        <Star 
          className={`${iconSizes[iconSize]}`} 
          style={{ color: iconColor }}
        />
      );
    }
    
    // Custom ReactNode icon
    return icon;
  };

  // Render title lines
  const renderTitleLines = () => {
    return titleLines.map((line, index) => {
      const textStyle: React.CSSProperties = {
        color: line.color || "hsl(var(--foreground))",
      };

      if (line.highlightColor) {
        return (
          <span
            key={index}
            className="inline-block px-2 py-1 font-display font-black text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight"
            style={{
              ...textStyle,
              backgroundColor: line.highlightColor,
            }}
          >
            {line.text}
          </span>
        );
      }

      return (
        <span
          key={index}
          className="block font-display font-black text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight"
          style={textStyle}
        >
          {line.text}
        </span>
      );
    });
  };

  return (
    <div 
      className={`relative overflow-hidden ${className}`}
      style={{ 
        aspectRatio: aspectRatio !== "auto" ? aspectRatio : undefined,
        minHeight: aspectRatio === "auto" ? minHeight : undefined,
      }}
    >
      {/* Background Image */}
      {backgroundImage && (
        <div 
          className="absolute inset-0 bg-cover bg-center bg-no-repeat"
          style={{ backgroundImage: `url(${backgroundImage})` }}
        />
      )}

      {/* Background Overlay */}
      {backgroundOverlay && (
        <div 
          className="absolute inset-0"
          style={{ backgroundColor: backgroundOverlay }}
        />
      )}

      {/* Decorative Border */}
      {borderColor && (
        <div 
          className="absolute inset-4 sm:inset-6 md:inset-8 border-2 pointer-events-none"
          style={{ borderColor }}
        />
      )}

      {/* Content */}
      <div 
        className={`relative z-10 flex flex-col h-full w-full px-6 sm:px-8 md:px-12 py-8 ${alignmentClasses[alignment]} ${verticalClasses[verticalPosition]}`}
      >
        {/* Icon */}
        {icon !== "none" && (
          <div className="mb-4">
            {renderIcon()}
          </div>
        )}

        {/* Title Lines */}
        <div className={`flex flex-col gap-1 ${alignment === "center" ? "items-center" : alignment === "right" ? "items-end" : "items-start"}`}>
          {renderTitleLines()}
        </div>
      </div>
    </div>
  );
};

export default ChapterHero;
