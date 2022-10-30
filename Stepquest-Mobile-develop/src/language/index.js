import VN from './vn';
import FR from './fr';
import EN from './en';

export const trans = (language, text) => {
  if (language === 'en') {
    return EN[text] || text;
  }
  if (language === 'vn') {
    return VN[text] || text;
  }
  if (language === 'fr') {
    return FR[text] || text;
  }
};
