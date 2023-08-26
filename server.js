const express = require('express');
const { exec } = require('child_process');

const app = express();
const port = process.env.PORT || 3000;

app.get('/endpoint', (req, res) => {
  const slackName = req.query.slack_name || '';
  const track = req.query.track || '';
  exec(`php task.php ${slackName} ${track}`, (error, stdout, stderr) => {
    if (error) {
      console.error(`Error executing PHP script: ${error}`);
      return res.status(500).json({ error: 'Internal Server Error' });
    }
    const response = JSON.parse(stdout);
    res.json(response);
  });
});

app.listen(port, () => {
  console.log(`Node.js server listening on port ${port}`);
});
