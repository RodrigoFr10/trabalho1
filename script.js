const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Configuração do middleware body-parser
app.use(bodyParser.urlencoded({ extended: true }));

// Configuração da conexão com o banco de dados
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'loja'
});

db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log('Conectado ao banco de dados MySQL');
});

// Função para atualizar produto
function atualizarProd(req, res) {
    if (req.body.atlProd) {
        const id = db.escape(req.body.inputId);
        const nome = db.escape(req.body.inputNome);
        const preco = db.escape(req.body.inputPreco);
        const quant = db.escape(req.body.inputQuant);

        if (nome && preco && quant) {
            const query = `UPDATE produtos SET nome=${nome}, preco=${preco}, quantidade=${quant} WHERE id=${id}`;
            console.log(query); // Para depuração

            db.query(query, (err, result) => {
                if (err) {
                    console.error('Erro ao atualizar dados:', err);
                    res.send('Erro ao atualizar dados');
                } else {
                    console.log('Produto atualizado com sucesso');
                    res.send('Produto atualizado com sucesso');
                }
            });
        } else {
            console.log('Preencha todos os dados corretamente. Dados preenchidos -->');
            console.log(`Nome: ${nome} | Preço: ${preco} | Quantidade: ${quant} | ID: ${id}`);
            res.send('Preencha todos os dados corretamente.');
        }
    }
}

// Endpoint para a atualização de produto
app.post('/atualizarProd', atualizarProd);

// Inicia o servidor
app.listen(port, () => {
    console.log(`Servidor rodando na porta ${port}`);
});
