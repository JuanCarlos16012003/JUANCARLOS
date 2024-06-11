const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.json());

app.post('/api/orders', (req, res) => {
    const order = req.body;
    // Aquí debes guardar el pedido en tu base de datos
    console.log(order);
    res.status(200).send({ message: 'Pedido recibido' });
});

app.listen(3000, () => {
    console.log('Server is running on port 3000');
});
