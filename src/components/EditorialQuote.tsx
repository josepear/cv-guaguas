import { ReactNode } from "react";

interface EditorialQuoteProps {
  children: ReactNode;
  author?: string;
  source?: string;
}

const EditorialQuote = ({ children, author, source }: EditorialQuoteProps) => {
  return (
    <blockquote className="editorial-quote my-8 md:my-12 py-4">
      <p className="text-xl md:text-2xl text-foreground/90 leading-relaxed mb-4">
        {children}
      </p>
      {(author || source) && (
        <footer className="text-sm text-muted-foreground">
          {author && <cite className="not-italic font-medium">{author}</cite>}
          {source && <span className="ml-2">— {source}</span>}
        </footer>
      )}
    </blockquote>
  );
};

export default EditorialQuote;
