interface CounterProps {
  value: number;
  increment: () => void;
  decrement: () => void;
}

export const Counter = ({ value, increment, decrement }: CounterProps) => {
  return (
    <div className="flex items-center gap-1">
      {/* Nút giảm */}
      <div className="cursor-pointer text-indigo-600" onClick={decrement}>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          strokeWidth={1.5}
          stroke="currentColor"
          className="h-6 w-6"
        >
          <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
          />
        </svg>
      </div>

      {/* Giá trị */}
      <span className="w-6 text-center text-indigo-700">{value}</span>

      {/* Nút tăng */}
      <div className="cursor-pointer text-indigo-600" onClick={increment}>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          strokeWidth={1.5}
          stroke="currentColor"
          className="h-6 w-6"
        >
          <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
          />
        </svg>
      </div>
    </div>
  );
};
