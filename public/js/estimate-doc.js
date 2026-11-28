/*
 * Estimate document (GST estimate layout) shared by the Leads page Estimation popup
 * (Preview / Print) and the customer-facing estimate page linked from WhatsApp.
 * Exposes window.EstimateDoc.
 */
(function () {
  function escapeHtml(str) {
    if (str === null || str === undefined || str === '') return '';
    return String(str).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  function estRound(n) { return Math.round((Number(n) || 0) * 100) / 100; }
  function estMoney(v) {
    return '₹ ' + estRound(v).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
  function estMoneyShort(v) {
    return '₹' + estRound(v).toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
  }
  function estDay(ymd, sep) {
    var p = String(ymd || '').slice(0, 10).split('-');
    if (p.length !== 3) return '';
    if (sep) return p[2] + sep + p[1] + sep + p[0];
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return p[2] + ' ' + months[Number(p[1]) - 1] + ' ' + p[0];
  }

  // Indian-system amount in words: 7500 -> "Seven Thousand Five Hundred Rupees only"
  function estWords(amount) {
    var ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    var tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
    function two(n) { return n < 20 ? ones[n] : tens[Math.floor(n / 10)] + (n % 10 ? ' ' + ones[n % 10] : ''); }
    function three(n) { return (n >= 100 ? ones[Math.floor(n / 100)] + ' Hundred' + (n % 100 ? ' ' : '') : '') + (n % 100 ? two(n % 100) : ''); }
    function words(n) {
      if (n === 0) return 'Zero';
      var out = [];
      var crore = Math.floor(n / 10000000); n %= 10000000;
      var lakh = Math.floor(n / 100000); n %= 100000;
      var thousand = Math.floor(n / 1000); n %= 1000;
      if (crore) out.push(words(crore) + ' Crore');
      if (lakh) out.push(two(lakh) + ' Lakh');
      if (thousand) out.push(two(thousand) + ' Thousand');
      if (n) out.push(three(n));
      return out.join(' ');
    }
    var rupees = Math.floor(estRound(amount));
    var paise = Math.round((estRound(amount) - rupees) * 100);
    return words(rupees) + ' Rupees' + (paise ? ' and ' + two(paise) + ' Paise' : '') + ' only';
  }

  // GSTIN starts with the state code: "32..." -> "32-Kerala"
  var EST_STATES = { '01': 'Jammu and Kashmir', '02': 'Himachal Pradesh', '03': 'Punjab', '04': 'Chandigarh', '05': 'Uttarakhand', '06': 'Haryana', '07': 'Delhi', '08': 'Rajasthan', '09': 'Uttar Pradesh', '10': 'Bihar', '11': 'Sikkim', '12': 'Arunachal Pradesh', '13': 'Nagaland', '14': 'Manipur', '15': 'Mizoram', '16': 'Tripura', '17': 'Meghalaya', '18': 'Assam', '19': 'West Bengal', '20': 'Jharkhand', '21': 'Odisha', '22': 'Chhattisgarh', '23': 'Madhya Pradesh', '24': 'Gujarat', '26': 'Dadra and Nagar Haveli and Daman and Diu', '27': 'Maharashtra', '29': 'Karnataka', '30': 'Goa', '31': 'Lakshadweep', '32': 'Kerala', '33': 'Tamil Nadu', '34': 'Puducherry', '35': 'Andaman and Nicobar Islands', '36': 'Telangana', '37': 'Andhra Pradesh', '38': 'Ladakh' };
  function estState(gstin) {
    var code = String(gstin || '').slice(0, 2);
    return EST_STATES[code] ? code + '-' + EST_STATES[code] : '';
  }
  function estAsset(path) {
    if (!path) return '';
    return /^(https?:|data:|\/)/.test(path) ? path : '/' + path;
  }

  // Line maths: the entered price includes GST, so taxable = price / (1 + rate)
  function estLine(it) {
    var qty = Number(it.quantity) || 0;
    var rate = Number(it.gst_rate) || 0;
    var amount = estRound((Number(it.price) || 0) * qty);
    var taxable = rate > 0 ? estRound(amount / (1 + rate / 100)) : amount;
    var unitTaxable = qty ? taxable / qty : 0;
    return { qty: qty, rate: rate, amount: amount, taxable: taxable, gst: estRound(amount - taxable), unitTaxable: unitTaxable };
  }

  // The estimate document (preview + print), laid out like the shop's GST estimate sample
  function estDocHtml(lead, e, s, autoPrint) {
    lead = lead || {};
    s = s || {};
    var company = s.company_name || 'Polish Panda Auto Spa';
    var logo = s.company_logo_url || estAsset(s.company_logo); // same URL as the invoice PDF
    var signature = s.signature_url || estAsset(s.signature);
    var seal = s.seal_url || estAsset(s.seal);
    var state = estState(s.company_gstin);
    var items = e.items || [];
    var lines = items.map(estLine);
    var totalQty = 0, totalGst = 0, totalAmount = 0;
    lines.forEach(function (l) { totalQty += l.qty; totalGst += l.gst; totalAmount += l.amount; });

    var itemRows = items.map(function (it, i) {
      var l = lines[i];
      return '<tr><td>' + (i + 1) + '</td><td>' + escapeHtml(it.name) + '</td><td>' + escapeHtml(it.hsn || '') + '</td>' +
        '<td class="r">' + l.qty + '</td><td class="r">' + escapeHtml(it.unit || 'Nos') + '</td>' +
        '<td class="r">' + estMoney(l.unitTaxable) + '</td>' +
        '<td class="r">' + estMoney(l.gst) + ' (' + estRound(l.rate).toFixed(1) + '%)</td>' +
        '<td class="r">' + estMoney(l.amount) + '</td></tr>';
    }).join('');

    // HSN-wise tax summary (CGST and SGST are half the GST rate each)
    var groups = {}, order = [];
    items.forEach(function (it, i) {
      var key = (it.hsn || '—') + '|' + lines[i].rate;
      if (!groups[key]) { groups[key] = { hsn: it.hsn || '—', rate: lines[i].rate, taxable: 0, gst: 0 }; order.push(key); }
      groups[key].taxable += lines[i].taxable;
      groups[key].gst += lines[i].gst;
    });
    var sumTaxable = 0, sumCgst = 0, sumSgst = 0, sumTax = 0;
    var taxRows = order.map(function (k) {
      var g = groups[k];
      var cgst = estRound(g.gst / 2), sgst = estRound(g.gst - cgst);
      sumTaxable += g.taxable; sumCgst += cgst; sumSgst += sgst; sumTax += g.gst;
      return '<tr><td>' + escapeHtml(g.hsn) + '</td><td class="r">' + estMoney(g.taxable) + '</td>' +
        '<td class="r">' + estRound(g.rate / 2).toFixed(1) + '%</td><td class="r">' + estMoney(cgst) + '</td>' +
        '<td class="r">' + estRound(g.rate / 2).toFixed(1) + '%</td><td class="r">' + estMoney(sgst) + '</td>' +
        '<td class="r">' + estMoney(g.gst) + '</td></tr>';
    }).join('');

    var phoneDigits = String(lead.phone || '').replace(/[^0-9]/g, '');
    var contact = phoneDigits.length === 10 ? '+91' + phoneDigits : (lead.phone || '');
    var vehicle = [lead.vehicle, lead.vehicle_plate].filter(Boolean).join(' · ');

    return '<!doctype html><html><head><meta charset="utf-8"><title>' + escapeHtml(e.number || 'Estimate') + ' — Estimate</title><style>' +
      '*{box-sizing:border-box}body{font-family:Roboto,"Segoe UI",Arial,sans-serif;color:#000;margin:16px;font-size:13px;background:#fff}' +
      '.doc{border:1px solid #777}table{width:100%;border-collapse:collapse}td,th{border:1px solid #777;padding:6px 6px;vertical-align:top}' +
      'th{font-weight:700;text-align:left}.r{text-align:right}.c{text-align:center}b{font-weight:700}' +
      '.head td{border-top:0}.head td:first-child{border-left:0}.head td:last-child{border-right:0}' +
      '.co{display:flex;gap:16px;align-items:center}.co img{width:64px;height:64px;object-fit:contain}' +
      '.co h1{margin:0 0 3px;font-size:21px}.co div div{line-height:1.6}.lbl{font-weight:400}.big td{padding:8px 6px}' +
      '.items th,.items td{white-space:nowrap}.items td:nth-child(2){white-space:normal}.tot td{font-weight:700}' +
      '.tax th{text-align:center;vertical-align:middle}.sign{text-align:center;padding:14px 6px;height:150px}' +
      '.sign img{max-height:70px;max-width:180px;display:block}.sp{height:60px}' +
      '.sign-imgs{display:flex;align-items:center;justify-content:center;gap:14px;margin:10px auto}.sign img.seal{max-height:90px;max-width:90px;object-fit:contain}' +
      '@media screen{body{width:760px;min-width:760px}}@media print{body{margin:8mm}}</style></head><body><div class="doc">' +
      // company + estimate no / date
      '<table class="head"><tr><td style="width:50%" rowspan="2"><div class="co">' + (logo ? '<img src="' + escapeHtml(logo) + '" alt="" onerror="this.remove()">' : '') +
        '<div><h1>' + escapeHtml(company) + '</h1>' +
        (s.company_address ? '<div>' + escapeHtml(s.company_address) + '</div>' : '') +
        (s.company_phone ? '<div>Phone no.: ' + escapeHtml(s.company_phone) + '</div>' : '') +
        (s.company_email ? '<div>Email: ' + escapeHtml(s.company_email) + '</div>' : '') +
        (s.company_gstin ? '<div>GSTIN: ' + escapeHtml(s.company_gstin) + '</div>' : '') +
        (state ? '<div>State: ' + escapeHtml(state) + '</div>' : '') +
        '</div></div></td>' +
        '<td style="width:25%"><div>Estimate No.</div><b>' + escapeHtml(e.number || '') + '</b></td>' +
        '<td style="width:25%"><div>Date</div><b>' + estDay(e.date, '-') + '</b>' +
          (e.valid_until ? '<div style="margin-top:6px">Valid until</div><b>' + estDay(e.valid_until, '-') + '</b>' : '') + '</td></tr>' +
      '<tr><td colspan="2" rowspan="2"></td></tr>' +
      '<tr><td class="big"><div>Estimate For</div><p style="margin:8px 0"><b>' + escapeHtml(lead.name || '') + '</b></p>' +
        (vehicle ? '<p style="margin:8px 0">' + escapeHtml(vehicle) + '</p>' : '') +
        (contact ? '<div>Contact No.: ' + escapeHtml(contact) + '</div>' : '') + '</td></tr></table>' +
      // items
      '<table class="items"><thead><tr><th style="width:4%">#</th><th>Item name</th><th>HSN/ SAC</th><th class="r">Quantity</th><th class="r">Unit</th>' +
        '<th class="r">Price/ unit</th><th class="r">GST</th><th class="r">Amount</th></tr></thead><tbody>' + itemRows +
        '<tr class="tot"><td></td><td>Total</td><td></td><td class="r">' + estRound(totalQty) + '</td><td></td><td></td>' +
        '<td class="r">' + estMoney(totalGst) + '</td><td class="r">' + estMoney(totalAmount) + '</td></tr></tbody></table>' +
      // words + amounts
      '<table><tr><td style="width:50%"><div>Estimate Amount In Words</div><p style="margin:8px 0 0"><b>' + estWords(e.total) + '</b></p></td>' +
        '<td rowspan="2" style="width:50%;padding:0"><table style="height:100%"><tr><td style="border:0;border-bottom:1px solid #777"><b>Amounts:</b>' +
          '<div style="display:flex;justify-content:space-between;margin-top:8px"><span>Sub Total</span><span>' + estMoney(e.subtotal) + '</span></div>' +
          (e.discount > 0 ? '<div style="display:flex;justify-content:space-between;margin-top:6px"><span>Discount</span><span>- ' + estMoney(e.discount) + '</span></div>' : '') +
        '</td></tr><tr><td style="border:0"><div style="display:flex;justify-content:space-between"><b>Total</b><b>' + estMoney(e.total) + '</b></div></td></tr></table></td></tr>' +
        '<tr><td><div>Description</div><p style="margin:8px 0 0"><b>' + (e.notes ? escapeHtml(e.notes).replace(/\n/g, '<br>') : '—') + '</b></p></td></tr></table>' +
      // HSN tax summary
      '<table class="tax"><tr><th rowspan="2">HSN/ SAC</th><th rowspan="2">Taxable amount</th><th colspan="2">CGST</th><th colspan="2">SGST</th><th rowspan="2">Total Tax Amount</th></tr>' +
        '<tr><th>Rate</th><th>Amount</th><th>Rate</th><th>Amount</th></tr>' + taxRows +
        '<tr class="tot"><td class="r">Total</td><td class="r">' + estMoney(sumTaxable) + '</td><td></td><td class="r">' + estMoney(sumCgst) + '</td>' +
        '<td></td><td class="r">' + estMoney(sumSgst) + '</td><td class="r">' + estMoney(sumTax) + '</td></tr></table>' +
      // signatory
      '<table><tr><td style="width:50%;border-bottom:0"></td><td class="sign" style="border-bottom:0"><div>For, ' + escapeHtml(company) + '</div>' +
        (signature || seal
          ? '<div class="sign-imgs">' +
              (seal ? '<img class="seal" src="' + escapeHtml(seal) + '" alt="" onerror="this.remove()">' : '') +
              (signature ? '<img src="' + escapeHtml(signature) + '" alt="" onerror="this.remove()">' : '') +
            '</div>'
          : '<div class="sp"></div>') +
        '<div>Authorized Signatory</div></td></tr></table>' +
      '</div>' + (autoPrint ? '<script>window.onload=function(){window.print();}<\/script>' : '') + '</body></html>';
  }

  // opts.autoPrint: open the print dialog on load; opts.downloadBar: show a "Download PDF" bar (customer page)
  function html(lead, est, settings, opts) {
    opts = opts || {};
    var doc = estDocHtml(lead, est, settings, !!opts.autoPrint);
    if (opts.downloadBar) {
      // customer page: phones show the whole page scaled down (like a PDF) instead of squeezing the layout
      doc = doc.replace('<meta charset="utf-8">', '<meta charset="utf-8"><meta name="viewport" content="width=800">');
      var bar = '<style>.dl-bar{position:sticky;top:0;z-index:5;display:flex;align-items:center;justify-content:space-between;gap:12px;' +
        'padding:10px 14px;margin:-16px -16px 14px;background:#111;color:#fff;font-size:14px}.dl-bar button{border:0;border-radius:8px;' +
        'background:#e3121b;color:#fff;font-weight:700;font-size:14px;padding:10px 16px;cursor:pointer}' +
        '@media print{.dl-bar{display:none}}</style><div class="dl-bar"><span>Estimate ' + escapeHtml(est.number || '') + '</span>' +
        '<button type="button" onclick="window.print()">Download PDF</button></div>';
      doc = doc.replace('<div class="doc">', bar + '<div class="doc">');
    }
    return doc;
  }

  window.EstimateDoc = {
    html: html,
    escapeHtml: escapeHtml,
    round: estRound,
    money: estMoney,
    moneyShort: estMoneyShort,
    day: estDay,
    words: estWords,
    line: estLine
  };
})();
