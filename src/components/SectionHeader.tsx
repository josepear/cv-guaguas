interface SectionHeaderProps {
  children: React.ReactNode;
  highlighted?: boolean;
  className?: string;
}

const SectionHeader = ({ children, highlighted = true, className = "" }: SectionHeaderProps) => {
  if (highlighted) {
    return (
      <h3 className={`section-header-highlighted ${className}`}>
        {children}
      </h3>
    );
  }
  
  return (
    <h3 className={`font-serif text-xl md:text-2xl font-bold text-foreground mt-12 mb-6 uppercase tracking-wide ${className}`}>
      {children}
    </h3>
  );
};

export default SectionHeader;
