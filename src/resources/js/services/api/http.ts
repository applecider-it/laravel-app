import axios from "axios";

/**
 * APIのhttp関連
 */

/** JSON通信用のヘッダー */
function jsonRequestHeaders() {
  const headers = {
    Accept: "application/json",
    "Content-Type": "application/json",
  };

  return headers;
}

/**
 * API送信
 *
 * ```
 * options:
 * multipart: trueの場合は、マルチパート指定
 * ```
 */
export async function sendApi(
  method: string,
  url: string,
  data: any = {},
  options: any = {},
) {
  const headers = jsonRequestHeaders();

  // マルチパート指定の時はContent-Typeを変更
  if ("multipart" in options && options.multipart)
    headers["Content-Type"] = "multipart/form-data";

  const upperMethod = method.toUpperCase();

  const config = {
    method: upperMethod,
    url,
    headers,
    ...(upperMethod === "GET" ? { params: data } : { data }),
  };

  console.log("sendApi", { config });

  const response = await axios.request(config);

  return response;
}
