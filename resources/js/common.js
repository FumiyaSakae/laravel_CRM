const n12br = (str) => {
  var res = str.replace(/\r\n/g, '<br>');
  res = res.replace(/(\n|\r)/g, '<br>');

  return res;
}

export { n12br }