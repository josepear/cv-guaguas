import { ReactNode } from "react";

interface TwoColumnsProps {
  left: ReactNode;
  right: ReactNode;
}

const TwoColumns = ({ left, right }: TwoColumnsProps) => (
  <div className="grid grid-cols-1 md:grid-cols-[40%_1fr] gap-0 my-8">
    <div className="pr-0 md:pr-8 pb-8 md:pb-0 border-b md:border-b-0 md:border-r border-border">
      {left}
    </div>
    <div className="pt-8 md:pt-0 md:pl-8">
      {right}
    </div>
  </div>
);

export default TwoColumns;
