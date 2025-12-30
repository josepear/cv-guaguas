interface ContentImageProps {
  src: string;
  alt: string;
  caption?: string;
  fullWidth?: boolean;
}

const ContentImage = ({ src, alt, caption, fullWidth = false }: ContentImageProps) => {
  return (
    <figure className={`my-8 md:my-12 ${fullWidth ? '-mx-4 md:-mx-8' : ''}`}>
      <div className="overflow-hidden rounded bg-muted/20">
        <img 
          src={src} 
          alt={alt}
          className="w-full h-auto object-cover transition-transform duration-500 hover:scale-[1.02]"
          loading="lazy"
        />
      </div>
      {caption && (
        <figcaption className="mt-3 text-sm text-muted-foreground italic text-center">
          {caption}
        </figcaption>
      )}
    </figure>
  );
};

export default ContentImage;
