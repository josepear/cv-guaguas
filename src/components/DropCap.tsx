import { ReactNode } from "react";

interface DropCapProps {
  children: ReactNode;
}

const DropCap = ({ children }: DropCapProps) => {
  if (typeof children !== "string") return <p>{children}</p>;
  
  const firstLetter = children.charAt(0);
  const rest = children.slice(1);
  
  return (
    <p className="drop-cap-paragraph">
      <span className="drop-cap">{firstLetter}</span>
      {rest}
    </p>
  );
};

export default DropCap;
