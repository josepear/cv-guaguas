import { Link } from "react-router-dom";
import { Home, Menu, X } from "lucide-react";

interface HeaderProps {
  onMenuToggle: () => void;
  isMenuOpen: boolean;
  showMenuButton?: boolean;
}

const Header = ({ onMenuToggle, isMenuOpen, showMenuButton = true }: HeaderProps) => {
  return (
    <header className="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-4 py-3 bg-sidebar/95 backdrop-blur-sm border-b border-sidebar-border">
      {/* Menu Toggle - Left */}
      {showMenuButton && (
        <button
          onClick={onMenuToggle}
          className="flex items-center gap-2 px-3 py-2 text-foreground hover:text-gold transition-colors"
        >
          {isMenuOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
          <span className="text-sm uppercase tracking-wider font-sans">Menú</span>
        </button>
      )}
      
      {!showMenuButton && <div />}

      {/* Home Link - Right */}
      <Link 
        to="/" 
        className="flex items-center gap-2 px-3 py-2 text-foreground hover:text-gold transition-colors"
      >
        <Home className="w-4 h-4" />
        <span className="text-sm uppercase tracking-wider font-sans">Inicio</span>
      </Link>
    </header>
  );
};

export default Header;
