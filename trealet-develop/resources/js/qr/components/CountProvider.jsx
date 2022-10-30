import React, { createContext, useContext, useState } from "react";

export const CountContext = createContext({});
const CountProvider = (props) => {
  const [count, setCount] = useState(0);
  const [answered, setAnswered] = useState({ wrong: [], correct: [] });

  const updateAnswered = (check, data) => {
    if (check) {
      setAnswered({ ...answered, correct: [...answered.correct, data] });
    } else {
      setAnswered({ ...answered, wrong: [...answered.wrong, data] });
    }
  };
  const [totalQuestion, setTotalQuestion] = useState(0);
  const { children } = props;
  return (
    <CountContext.Provider
      value={{
        count,
        setCount,
        totalQuestion,
        setTotalQuestion,
        updateAnswered,
        answered,
      }}
    >
      {children}
    </CountContext.Provider>
  );
};

export default CountProvider;
