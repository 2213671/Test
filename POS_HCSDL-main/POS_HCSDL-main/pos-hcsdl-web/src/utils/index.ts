export const fmtCurrency = (v?: number | string | null) => {
  if (v === null || v === undefined) return '—';
  return v.toLocaleString('vi-VN') + ' ₫';
};

export const fmtDate = iso => {
  try {
    return new Date(iso).toLocaleString('vi-VN');
  } catch {
    return iso;
  }
};
