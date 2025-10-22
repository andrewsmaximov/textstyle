import fetch from 'node-fetch';
import fs from 'fs';

const url = process.env.SITE_URL || 'https://textstyler.neurofabrika.store';
const mustHave = [
  '/', '/robots.txt', '/sitemap.xml', '/favicon.ico'
];

async function main() {
  const report = [];
  for (const p of mustHave) {
    try {
      const res = await fetch(url + p);
      report.push({ path: p, status: res.status });
    } catch (e) {
      report.push({ path: p, status: 0, error: String(e) });
    }
  }
  if (!fs.existsSync('reports')) fs.mkdirSync('reports', { recursive: true });
  fs.writeFileSync('reports/basic-check.json', JSON.stringify(report, null, 2));
  const bad = report.filter(r => r.status !== 200 && r.path !== '/sitemap.xml'); // allow missing sitemap early
  if (bad.length) {
    console.error('Missing/failed endpoints:', bad);
    process.exit(1);
  }
  console.log('Basic check OK');
}
main();
