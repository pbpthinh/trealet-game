class streamline {
  constructor(token) {
    this.authzToken = token;
  }

  init = token => {
    this.authzToken = token;
  };

  setToken(token) {
    this.authzToken = token;
  }

  async setOnlyToken(token) {
    this.authzToken = token;
  }

  getToken() {
    return this.authzToken;
  }

  clearToken() {
    this.authzToken = '';
  }
}

const streamlineWorker = new streamline();
export default streamlineWorker;
