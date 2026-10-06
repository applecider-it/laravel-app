/** 指定のマイクロタイムスリープ。1000で1秒。 */
export const sleep = (ms: number): Promise<void> => {
  return new Promise((resolve) => setTimeout(resolve, ms));
};