
# Planeja+

## Descrição
O **Planeja+** é um sistema de agendamento desenvolvido em PHP, utilizando Bootstrap para estilização e MySQL como banco de dados. Ele foi projetado para permitir que os usuários cadastrem tarefas, visualizem e gerenciem seus agendamentos de forma simples e eficiente.

## Funcionalidades

### 1. Cadastro de Usuário
- Permite que novos usuários se cadastrem no sistema.
- Campos obrigatórios: Nome, E-mail, e Senha.

### 2. Login
- Autentica os usuários cadastrados.
- Protege as páginas restritas com verificação de sessão.

### 3. Agendamento de Tarefas
- Usuários logados podem cadastrar tarefas com nome, descrição e data/hora.

### 4. Listagem de Agendamentos
- Exibe todos os agendamentos do usuário logado em uma tabela.
- Possui opção para cancelar agendamentos.

### 5. Cancelamento de Agendamentos
- Permite excluir um agendamento através da página de listagem.
- Exibe mensagens de sucesso ou erro após a ação.

### 6. Logout
- Encerra a sessão do usuário logado e redireciona para a página de login.

## Estrutura do Projeto

### Diretórios e Arquivos

- **autenticar.php**: Processa o login dos usuários.
- **cadastro.php**: Gerencia o cadastro de novos usuários.
- **cancelar_agendamento.php**: Realiza a exclusão de agendamentos existentes.
- **conexao.php**: Configuração da conexão com o banco de dados MySQL.
- **index.php**: Página inicial para realizar agendamentos.
- **login.php**: Interface de login do sistema.
- **logout.php**: Encerra a sessão do usuário.
- **pagina_listar.php**: Exibe a listagem dos agendamentos do usuário logado.
- **processa.php**: Processa os dados enviados pelo formulário de agendamento.
- **Planejamais.sql**: Script para criação do banco de dados e tabelas necessárias.
- **loader.gif**: Recurso visual para carregamento.

### Diretórios Adicionais

- **css/**: Contém os arquivos de estilização (CSS).
- **js/**: Scripts JavaScript usados no sistema.
- **bootstrap-datetimepicker/**: Biblioteca para seleção de datas e horas.

## Requisitos

- PHP 7.4 ou superior.
- Servidor MySQL.
- Navegador moderno (Google Chrome, Firefox, etc.).

## Configuração

1. Clone o repositório ou extraia os arquivos do ZIP em seu servidor.
2. Configure o arquivo `conexao.php` com as credenciais do seu banco de dados MySQL:

   ```php
   $servidor = "localhost";
   $usuario = "seu_usuario";
   $senha = "sua_senha";
   $dbname = "Planejamais";
   ```

3. Importe o arquivo `Planejamais.sql` em seu banco de dados para criar as tabelas e os dados iniciais.
4. Acesse o sistema através do navegador.

## Como Usar

1. Cadastre-se através da página de cadastro.
2. Realize o login com suas credenciais.
3. Gerencie seus agendamentos utilizando as funcionalidades de criação, visualização e exclusão de tarefas.

## Autor
Sistema desenvolvido por [igor honorio das Flores ferreira].
