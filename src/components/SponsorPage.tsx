import React from "react";

interface SponsorPageProps {
  logoSrc: string;
  logoAlt: string;
  children: React.ReactNode;
  ficha?: React.ReactNode;
  redes?: React.ReactNode;
  redesTitle?: string;
}

const SponsorPage = ({ logoSrc, logoAlt, children, ficha, redes, redesTitle = "Web y redes sociales" }: SponsorPageProps) => {
  return (
    <div className="rounded-2xl p-8 md:p-12" style={{ background: "hsl(45 100% 50%)" }}>
      {/* Logo */}
      <div className="flex items-center justify-center min-h-[160px] md:min-h-[300px] mb-8">
        <img
          src={logoSrc}
          alt={logoAlt}
          className="max-h-[120px] md:max-h-[200px] w-auto"
          style={{ filter: "brightness(0)" }}
        />
      </div>

      {/* Texto */}
      <div className="text-[hsl(220,50%,12%)] space-y-4 text-base leading-relaxed">
        {children}
      </div>

      {/* Ficha técnica */}
      {ficha && (
        <div className="mt-8 pt-6 border-t border-[hsl(220,50%,12%,0.15)]">
          <p className="font-bold text-[hsl(220,50%,12%)] text-sm uppercase tracking-wider mb-3">Ficha técnica de la empresa</p>
          <div className="text-[hsl(220,50%,12%)] text-sm leading-relaxed">
            {ficha}
          </div>
        </div>
      )}

      {/* Redes sociales */}
      {redes && (
        <div className="mt-6 pt-4 border-t border-[hsl(220,50%,12%,0.15)]">
          <p className="font-bold text-[hsl(220,50%,12%)] text-sm uppercase tracking-wider mb-3">{redesTitle}</p>
          <div className="text-[hsl(220,50%,12%)] text-sm leading-relaxed [&_a]:underline [&_a]:font-medium">
            {redes}
          </div>
        </div>
      )}
    </div>
  );
};

export default SponsorPage;
