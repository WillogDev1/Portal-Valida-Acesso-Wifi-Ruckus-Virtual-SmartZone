# Portal Colégio Ser Acessa Wi-Fi :shipit:
Portal de validação de acesso ao Wifi esenvolvido para colégio, no meu atual serviço.

# Linguagems e Ferramentas :hammer:
- PHP
- JAVASCRIPT
- HTML
- CSS
# Estrutura :file_folder:
- MVC
- Vendor
- Session
- Autoload
- Rotas

# Sobre :heavy_exclamation_mark:
Projeto vem validar o acesso ao Wi-fi do Colégio Ser atraves do presente website. As validações devem ocorrer para:
- Visitantes
- Colaboradores
- Alunos

# Visitante
A validação deve ocorrer atraves de SMS que sera enviado ao usuario um token de 4 digitos.

# Colaboradores
A validação deve ocorrer atraves de uma planilha contendo todos os numeros de crachas de colaboradores. A alimentação dessas planilhas sera feito por forms. Apenas RH pode lançar.

# Alunos
A validação deve ocorrer atraves de uma planilha contendo todos os numeros de RA dos alunos. A alimentação dessas planilhas sera feito por forms. Apenas coordencação pode lançar.

# Segurança
- Token é salvo na sessão do usuario e enviado ao servidor.
- Tratativa de liberação é feita no servidor.
- Rotas não expondo estrutura.
