import { type FC, type ReactNode } from 'react';

interface ModalProps {
  isOpen: boolean;
  onClose: () => void;
  title?: string;
  children: ReactNode;
  footer?: ReactNode;
}
export const Modal: FC<ModalProps> = ({ isOpen, onClose, title, children }) => {
  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
      <div className="mx-4 w-full max-w-md rounded-lg bg-white shadow-lg">
        <div className="flex items-center justify-between p-4  border-b border-indigo-500">
          <h3 className="text-xl font-semibold text-indigo-700">{title}</h3>
          <button onClick={onClose} className="text-xl font-bold text-gray-500 hover:text-gray-700">
            &times;
          </button>
        </div>
        <div className="p-4">{children}</div>
      </div>
    </div>
  );
};
