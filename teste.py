import pandas as pd

def texto_para_tabela(texto, arquivo_excel):
    # Dividir o texto em linhas
    linhas = texto.strip().split('\n')
    
    # O título será a primeira linha
    titulo = linhas[0]
    
    # Os tópicos serão as linhas seguintes
    topicos = linhas[1:]
    
    # Criar um DataFrame com o título como cabeçalho e os tópicos como conteúdo
    df = pd.DataFrame({titulo: topicos})
    
    # Salvar o DataFrame em um arquivo Excel
    df.to_excel(arquivo_excel, index=False, engine='openpyxl')
    print(f"Tabela salva como {arquivo_excel}")

# Exemplo de uso
texto = """TPS9180:Provisão de conta, desprovisionamento e solicitações de alteração
1. Solicitações de provisionamento, desprovisionamento e alteração de perfil, como rescisão de reatribuição, licença e transferência, para contas e direitos, devem ser feitas por meio de um sistema formalizado de solicitação de acesso contendo fluxos de trabalho de revisão e aprovação, e uma trilha de auditoria à prova de violação fornecida ao Banco mediante solicitação.
2. Contas, exceto contas não humanas, que não foram utilizadas dentro de 90 dias consecutivos devem ser revogadas, exceto contas não humanas.
3. Novas contas que não forem utilizadas dentro de 20 dias após a criação devem ser revogadas.
4. Uma solicitação de remoção de acesso para uma conta de usuário final ou direito do Banco, o acesso deve ser desabilitado ou revogado dentro de:
a. Dois (2) dias úteis para saída de recursos do Banco ou transferência de cargos, licenças ou
b. Cinco (5) dias úteis para todos os outros processamentos de revogação, como contas inativas,
revisões de acesso e contas de serviço
5. Para contas não humanas (incluindo contas de serviço), o acesso inativo deve ser revogado se ficar
inativo por mais de 400 dias.
6. Para todas as outras contas e direitos usados em suporte ao Banco, devem existir políticas para
definir as regras que regem o momento das revogações de acesso resultantes de alterações nos
atributos de segurança dos proprietários da conta.
"""

# Gerar o Excel
texto_para_tabela(texto, "tabela_topicos.xlsx")
