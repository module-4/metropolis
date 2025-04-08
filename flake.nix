{
    description = "Future factory dev flake";

    inputs = {
        nixpkgs.url = "nixpkgs/nixos-unstable";
        flake-utils.url = "github:numtide/flake-utils";
    };

    outputs = { self, nixpkgs, flake-utils }:
        flake-utils.lib.eachDefaultSystem (system:
            let
                pkgs = import nixpkgs { inherit system; };

                # Define the aliases script
                sail = pkgs.writeShellScriptBin "sail" ''
                    exec ./vendor/bin/sail $@'';
                dev = pkgs.writeShellScriptBin "dev" ''
                    exec composer dev'';
                test = pkgs.writeShellScriptBin "test" ''
                    exec composer test'';
            in {
                # Define devShell with aliases
                devShell = pkgs.mkShell {
                    name = "laravel-dev-shell";
                    buildInputs = [
                        pkgs.docker
                        pkgs.docker-compose
                        pkgs.bun
                        pkgs.php84
                        pkgs.php84Packages.composer
                        pkgs.mysql84
                        sail
                        dev
                        test
                    ];

                    shellHook = ''
                        echo 'Future factory dev environment loaded'
                    '';
                };

                nixosModule = {
                    config = {
                        services.docker.enable = true;
                        virtualisation.docker.enable = true;

                        # Ensure Docker Compose is accessible system-wide
                        environment.systemPackages = with pkgs; [
                            docker-compose
                        ];
                    };
                };
        });
}
