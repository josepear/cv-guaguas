import { ReactNode, useRef } from "react";
import { Star } from "lucide-react";
import { motion, useScroll, useTransform } from "framer-motion";
import InlineSvgIcon from "./InlineSvgIcon";

export interface TitleLine {
  text: string;
  color?: string; // CSS color value
  highlightColor?: string; // Background highlight color
  fontWeight?: "normal" | "medium" | "semibold" | "bold" | "extrabold" | "black";
}

export interface ChapterHeroProps {
  backgroundImage?: string;
  backgroundOverlay?: string; // Overlay color with opacity (e.g., "rgba(0,0,0,0.5)" or "hsl(45 100% 50% / 0.8)")
  backgroundPosition?: string; // CSS background-position (default: "center top")
  icon?: "star" | "star-outline" | "none" | ReactNode;
  customIconSrc?: string; // URL to custom icon image (supports SVG, PNG, etc.)
  customIconColor?: string; // Color to apply to SVG icons (only works with SVG files)
  iconColor?: string;
  iconSize?: "sm" | "md" | "lg" | "xl";
  iconWidth?: number; // Custom width in pixels
  iconHeight?: number; // Custom height in pixels
  titleLines: TitleLine[];
  titleFontWeight?: "normal" | "medium" | "semibold" | "bold" | "extrabold" | "black";
  alignment?: "left" | "center" | "right";
  verticalPosition?: "top" | "center" | "bottom";
  className?: string;
  aspectRatio?: "16/9" | "4/3" | "3/2" | "21/9" | "1/1" | "auto";
  minHeight?: string;
  height?: string; // Fixed height (e.g., "500px", "60vh")
  borderColor?: string; // For decorative border like in example 1
}

const ChapterHero = ({
  backgroundImage,
  backgroundOverlay,
  backgroundPosition = "center top",
  icon = "star",
  customIconSrc,
  customIconColor,
  iconColor = "hsl(var(--gold))",
  iconSize = "md",
  iconWidth,
  iconHeight,
  titleLines,
  titleFontWeight = "black",
  alignment = "center",
  verticalPosition = "center",
  className = "",
  aspectRatio = "auto",
  minHeight = "400px",
  height,
  borderColor,
}: ChapterHeroProps) => {
  const heroRef = useRef(null);
  const { scrollYProgress } = useScroll({
    target: heroRef,
    offset: ["start start", "end start"],
  });
  const bgY = useTransform(scrollYProgress, [0, 1], ["0%", "20%"]);

  // Icon size mapping
  const iconSizes = {
    sm: { width: 32, height: 32 },
    md: { width: 48, height: 48 },
    lg: { width: 64, height: 64 },
    xl: { width: 96, height: 96 },
  };

  // Font weight mapping
  const fontWeights = {
    normal: "font-normal",
    medium: "font-medium",
    semibold: "font-semibold",
    bold: "font-bold",
    extrabold: "font-extrabold",
    black: "font-black",
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

  // Get icon dimensions
  const getIconDimensions = () => {
    if (iconWidth || iconHeight) {
      return {
        width: iconWidth || iconHeight || 48,
        height: iconHeight || iconWidth || 48,
      };
    }
    return iconSizes[iconSize];
  };

  const iconDims = getIconDimensions();

  // Render icon
  const renderIcon = () => {
    if (icon === "none") return null;
    
    // Custom icon image - use InlineSvgIcon for SVGs to support coloring
    if (customIconSrc) {
      const isSvg = customIconSrc.toLowerCase().endsWith(".svg");
      
      if (isSvg) {
        return (
          <InlineSvgIcon
            src={customIconSrc}
            color={customIconColor}
            width={iconDims.width}
            height={iconDims.height}
          />
        );
      }
      
      // Non-SVG images (PNG, JPG, etc.)
      return (
        <img 
          src={customIconSrc}
          alt="Chapter icon"
          style={{ 
            width: iconDims.width, 
            height: iconDims.height,
            objectFit: "contain"
          }}
          className="drop-shadow-lg"
        />
      );
    }
    
    if (icon === "star") {
      return (
        <Star 
          className="fill-current drop-shadow-lg"
          style={{ 
            color: iconColor,
            width: iconDims.width,
            height: iconDims.height
          }}
        />
      );
    }
    
    if (icon === "star-outline") {
      return (
        <Star 
          style={{ 
            color: iconColor,
            width: iconDims.width,
            height: iconDims.height
          }}
          className="drop-shadow-lg"
        />
      );
    }
    
    // Custom ReactNode icon
    return icon;
  };

  // Render title lines
  const renderTitleLines = () => {
    return titleLines.map((line, index) => {
      const lineWeight = line.fontWeight || titleFontWeight;
      const weightClass = fontWeights[lineWeight];
      
      const textStyle: React.CSSProperties = {
        color: line.color || "hsl(var(--foreground))",
      };

      if (line.highlightColor) {
        return (
          <span
            key={index}
            className={`inline-block px-2 py-1 font-display ${weightClass} text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight`}
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
          className={`block font-display ${weightClass} text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight`}
          style={textStyle}
        >
          {line.text}
        </span>
      );
    });
  };

  // Calculate container styles
  const containerStyle: React.CSSProperties = {};
  
  if (height) {
    containerStyle.height = height;
  } else if (aspectRatio !== "auto") {
    containerStyle.aspectRatio = aspectRatio;
  } else {
    containerStyle.minHeight = minHeight;
  }

  return (
    <div 
      ref={heroRef}
      className={`relative overflow-hidden w-full ${className}`}
      style={containerStyle}
    >
      {/* Background Image with Parallax */}
      {backgroundImage && (
        <motion.div 
          className="absolute inset-0 bg-cover bg-center bg-no-repeat will-change-transform"
          style={{ backgroundImage: `url(${backgroundImage})`, y: bgY, scale: 1.1 }}
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
        {(icon !== "none" || customIconSrc) && (
          <motion.div
            className="mb-4"
            initial={{ opacity: 0, scale: 0.6 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.5, delay: 0.2, ease: "easeOut" }}
          >
            {renderIcon()}
          </motion.div>
        )}

        {/* Title Lines */}
        <div className={`flex flex-col gap-1 ${alignment === "center" ? "items-center" : alignment === "right" ? "items-end" : "items-start"}`}>
          {titleLines.map((line, index) => {
            const lineWeight = line.fontWeight || titleFontWeight;
            const weightClass = fontWeights[lineWeight];
            const textStyle: React.CSSProperties = {
              color: line.color || "hsl(var(--foreground))",
            };

            const content = line.highlightColor ? (
              <span
                className={`inline-block px-2 py-1 font-display ${weightClass} text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight`}
                style={{ ...textStyle, backgroundColor: line.highlightColor }}
              >
                {line.text}
              </span>
            ) : (
              <span
                className={`block font-display ${weightClass} text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight`}
                style={textStyle}
              >
                {line.text}
              </span>
            );

            return (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: 0.4 + index * 0.15, ease: "easeOut" }}
              >
                {content}
              </motion.div>
            );
          })}
        </div>
      </div>
    </div>
  );
};

export default ChapterHero;
