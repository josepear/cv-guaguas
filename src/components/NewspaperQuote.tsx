interface NewspaperQuoteProps {
  children: React.ReactNode;
  source?: string;
}

const NewspaperQuote = ({ children, source }: NewspaperQuoteProps) => {
  return (
    <blockquote className="newspaper-quote">
      <p>{children}</p>
      {source && (
        <cite className="newspaper-quote-source">{source}</cite>
      )}
    </blockquote>
  );
};

export default NewspaperQuote;
