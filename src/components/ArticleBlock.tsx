interface ArticleBlockProps {
  number: string;
  children: React.ReactNode;
}

const ArticleBlock = ({ number, children }: ArticleBlockProps) => {
  return (
    <div className="article-block">
      <span className="article-number">Artículo {number}.</span>
      <span className="article-text">{children}</span>
    </div>
  );
};

export default ArticleBlock;
