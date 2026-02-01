import { useState, useEffect } from "react";

interface InlineSvgIconProps {
  src: string;
  color?: string;
  width?: number;
  height?: number;
  className?: string;
}

/**
 * Loads an SVG file and renders it inline, allowing color customization.
 * The color is applied by replacing fill and stroke attributes.
 */
const InlineSvgIcon = ({
  src,
  color,
  width = 48,
  height = 48,
  className = "",
}: InlineSvgIconProps) => {
  const [svgContent, setSvgContent] = useState<string | null>(null);
  const [error, setError] = useState(false);

  useEffect(() => {
    const fetchSvg = async () => {
      try {
        const response = await fetch(src);
        if (!response.ok) throw new Error("Failed to load SVG");
        
        let svgText = await response.text();
        
        // Parse and modify SVG
        const parser = new DOMParser();
        const doc = parser.parseFromString(svgText, "image/svg+xml");
        const svgElement = doc.querySelector("svg");
        
        if (!svgElement) {
          throw new Error("Invalid SVG");
        }

        // Set dimensions
        svgElement.setAttribute("width", String(width));
        svgElement.setAttribute("height", String(height));
        
        // Apply color if provided
        if (color) {
          // Replace fills and strokes on all elements
          const elements = svgElement.querySelectorAll("*");
          elements.forEach((el) => {
            const fill = el.getAttribute("fill");
            const stroke = el.getAttribute("stroke");
            
            // Replace fill if it's not "none"
            if (fill && fill !== "none") {
              el.setAttribute("fill", color);
            }
            
            // Replace stroke if it's not "none"
            if (stroke && stroke !== "none") {
              el.setAttribute("stroke", color);
            }
          });
          
          // Also set fill on the root SVG if it has one or set currentColor
          const rootFill = svgElement.getAttribute("fill");
          if (rootFill && rootFill !== "none") {
            svgElement.setAttribute("fill", color);
          }
        }

        setSvgContent(svgElement.outerHTML);
        setError(false);
      } catch (err) {
        console.error("Error loading SVG:", err);
        setError(true);
      }
    };

    if (src.toLowerCase().endsWith(".svg")) {
      fetchSvg();
    } else {
      setError(true);
    }
  }, [src, color, width, height]);

  if (error || !svgContent) {
    // Fallback to img tag for non-SVG or loading state
    return (
      <img
        src={src}
        alt="Icon"
        style={{ width, height, objectFit: "contain" }}
        className={`drop-shadow-lg ${className}`}
      />
    );
  }

  return (
    <span
      className={`inline-block drop-shadow-lg ${className}`}
      dangerouslySetInnerHTML={{ __html: svgContent }}
    />
  );
};

export default InlineSvgIcon;
