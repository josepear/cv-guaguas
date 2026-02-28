import { ReactNode } from "react";

interface PlayerProfileProps {
  name: string;
  subtitle?: string;
  imageSrc?: string;
  imageAlt?: string;
  imageCaption?: string;
  children: ReactNode;
  imagePosition?: "left" | "right";
}

const PlayerProfile = ({ 
  name, 
  subtitle,
  imageSrc, 
  imageAlt, 
  imageCaption,
  children,
  imagePosition = "left" 
}: PlayerProfileProps) => {
  return (
    <div className="player-profile my-12 md:my-16">
      {/* Player name header */}
      <h3 className="player-profile-name">
        {name}
      </h3>
      {subtitle && (
        <p className="text-sm text-muted-foreground italic mb-6">{subtitle}</p>
      )}
      
      {/* Content with optional image */}
      <div className={`flex flex-col ${imageSrc ? 'md:flex-row gap-8' : ''} ${imagePosition === 'right' ? 'md:flex-row-reverse' : ''}`}>
        {imageSrc && (
          <div className="md:w-2/5 flex-shrink-0">
            <figure>
              <img 
                src={imageSrc} 
                alt={imageAlt || name}
                className="w-full h-auto object-cover grayscale hover:grayscale-0 transition-all duration-700"
                loading="lazy"
              />
              {imageCaption && (
                <figcaption className="mt-2 text-xs text-muted-foreground italic leading-relaxed">
                  {imageCaption}
                </figcaption>
              )}
            </figure>
          </div>
        )}
        
        <div className={`${imageSrc ? 'md:w-3/5' : ''} reading-content`}>
          {children}
        </div>
      </div>
    </div>
  );
};

export default PlayerProfile;
