interface HighlightTextProps {
  children: React.ReactNode;
  highlightColor?: string;
  textColor?: string;
  className?: string;
}

const HighlightText = ({
  children,
  highlightColor = "#D4AF37",
  textColor = "#1a237e",
  className = "",
}: HighlightTextProps) => {
  return (
    <mark
      className={`px-1 py-0.5 rounded-sm font-semibold ${className}`}
      style={{
        backgroundColor: highlightColor,
        color: textColor,
      }}
    >
      {children}
    </mark>
  );
};

export default HighlightText;
