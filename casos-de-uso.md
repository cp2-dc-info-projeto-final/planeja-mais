
# Casos de Uso do Sistema Planeja+

## Caso de Uso 1: Cadastro de Usuário
**Ator Primário**: Novo Usuário

**Descrição**: Permite que novos usuários se cadastrem no sistema para acessar suas funcionalidades.

**Fluxo Principal**:
1. O usuário acessa a página de cadastro.
2. Preenche os campos obrigatórios: Nome, E-mail, Telefone (opcional) e Senha.
3. O sistema valida se o e-mail é único e armazena os dados no banco de dados.
4. O sistema confirma o cadastro e redireciona o usuário para a página de login.

**Fluxo Alternativo**:
- Caso o e-mail já esteja em uso, o sistema exibe uma mensagem de erro e solicita um novo e-mail.

---

## Caso de Uso 2: Login de Usuário
**Ator Primário**: Usuário Registrado

**Descrição**: Permite que usuários existentes autentiquem sua conta para acessar o sistema.

**Fluxo Principal**:
1. O usuário acessa a página de login.
2. Preenche os campos de e-mail e senha.
3. O sistema valida as credenciais com o banco de dados.
4. Se as credenciais forem válidas, o sistema cria uma sessão e redireciona o usuário para a página inicial.

**Fluxo Alternativo**:
- Caso as credenciais sejam inválidas, o sistema exibe uma mensagem de erro e solicita uma nova tentativa.

---

## Caso de Uso 3: Agendamento de Tarefa
**Ator Primário**: Usuário Logado

**Descrição**: Permite que usuários criem novos agendamentos de tarefas.

**Fluxo Principal**:
1. O usuário logado acessa a página inicial.
2. Preenche os campos obrigatórios: Nome, Tarefa, Data e Hora.
3. O sistema valida os dados e armazena o agendamento no banco de dados.
4. O sistema exibe uma mensagem de confirmação e lista os agendamentos realizados.

**Fluxo Alternativo**:
- Caso algum campo esteja vazio ou a data seja inválida, o sistema exibe uma mensagem de erro e solicita a correção.

---

## Caso de Uso 4: Listagem de Agendamentos
**Ator Primário**: Usuário Logado

**Descrição**: Permite que o usuário visualize os agendamentos realizados.

**Fluxo Principal**:
1. O usuário logado acessa a página de listagem de agendamentos.
2. O sistema exibe uma tabela com os seguintes dados:
   - Nome
   - Tarefa
   - Data e Hora
3. O usuário pode optar por cancelar um agendamento clicando no botão correspondente.

---

## Caso de Uso 5: Cancelamento de Agendamento
**Ator Primário**: Usuário Logado

**Descrição**: Permite que o usuário exclua um agendamento já criado.

**Fluxo Principal**:
1. O usuário logado acessa a página de listagem de agendamentos.
2. Clica no botão "Cancelar" ao lado do agendamento desejado.
3. O sistema solicita confirmação do usuário.
4. O sistema remove o agendamento do banco de dados e exibe uma mensagem de sucesso.

**Fluxo Alternativo**:
- Caso o agendamento não exista mais no banco de dados, o sistema exibe uma mensagem de erro.

---

## Caso de Uso 6: Logout
**Ator Primário**: Usuário Logado

**Descrição**: Permite que o usuário finalize sua sessão no sistema.

**Fluxo Principal**:
1. O usuário logado clica no botão "Logout" no menu superior.
2. O sistema encerra a sessão e redireciona o usuário para a página de login.
