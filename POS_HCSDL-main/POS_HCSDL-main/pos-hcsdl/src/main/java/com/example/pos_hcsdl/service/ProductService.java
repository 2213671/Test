package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.OptionResponse;
import com.example.pos_hcsdl.dto.ProductRequest;
import com.example.pos_hcsdl.dto.ProductResponse;
import com.example.pos_hcsdl.dto.ToppingResponse;
import com.example.pos_hcsdl.entity.*;
import com.example.pos_hcsdl.mapper.OptionMapper;
import com.example.pos_hcsdl.mapper.ProductMapper;
import com.example.pos_hcsdl.mapper.ToppingMapper;
import com.example.pos_hcsdl.repository.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ProductService {

    @Autowired
    private ProductRepository productRepository;

    @Autowired
    private OptionRepository optionRepository;

    @Autowired
    private ToppingRepository toppingRepository;

    @Autowired
    private MenuRepository menuRepository;

    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private ProductMapper productMapper;

    @Autowired
    private ToppingMapper toppingMapper;

    @Autowired
    private OptionMapper optionMapper;

    @Autowired
    private ProductOptionRepository productOptionRepository;

    @Autowired
    private ProductToppingRepository productToppingRepository;

    public ProductResponse createProduct(ProductRequest productRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));
        Menu menu = menuRepository.findById(productRequest.getMenuId())
                .orElseThrow(() -> new RuntimeException("Menu not found"));
        Product product = productMapper.getProduct(productRequest);
        product.setMenu(menu);
        product.setRestaurant(restaurant);
        product.setStatus("ACTIVE");
        Product productSaved = productRepository.save(product);
        List<Option> options = productRequest.getOptions()
                .stream()
                .map(optionId -> {
                    Option option = optionRepository.findById(optionId)
                            .orElseThrow(() -> new RuntimeException("Option not found"));
                    ProductOptionId id = new ProductOptionId();
                    id.setProductId(productSaved.getId());
                    id.setOptionId(option.getId());
                    ProductOption productOption = new ProductOption();
                    productOption.setId(id);
                    productOption.setProduct(productSaved);
                    productOption.setOption(option);
                    productOptionRepository.save(productOption);
                    return option;
                }).toList();

        List<Topping> toppings = productRequest.getToppings()
                .stream()
                .map(toppingId -> {
                    Topping topping = toppingRepository.findById(toppingId)
                            .orElseThrow(() -> new RuntimeException("Topping not found: " + toppingId));
                    ProductToppingId id = new ProductToppingId();
                    id.setProductId(productSaved.getId());
                    id.setToppingId(topping.getId());
                    ProductTopping productTopping = new ProductTopping();
                    productTopping.setId(id);
                    productTopping.setProduct(productSaved);
                    productTopping.setTopping(topping);
                    productToppingRepository.save(productTopping);
                    return topping;
                })
                .toList();

        ProductResponse productResponse = productMapper.getProductResponse(productSaved);
        productResponse.setOptions(optionMapper.getOptionResponseList(options));
        productResponse.setToppings(toppingMapper.getToppingResponseList(toppings));

        return productResponse;
    }

    public List<ProductResponse> getProductByRestaurant(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));
        List<Product> products = productRepository.findAllByRestaurant(restaurant);

        return getProductResponse(products);
    }

    public List<ProductResponse> getProductByMenu(String menuId) {
        Menu menu = menuRepository.findById(menuId)
                .orElseThrow(() -> new RuntimeException("Menu not found"));
        List<Product> products = productRepository.findAllByMenu(menu);

        return getProductResponse(products);
    }

    private List<ProductResponse> getProductResponse(List<Product> products) {
        return products.stream().map(product -> {
            List<ProductTopping> productToppings = productToppingRepository.findAllByProduct(product);

            List<ToppingResponse> toppingResponses = toppingMapper.getToppingResponseList(
                    toppingRepository.findAllById(
                            productToppings.stream()
                                    .map(pt -> pt.getTopping().getId())
                                    .toList()
                    )
            );

            List<ProductOption> productOptions = productOptionRepository.findAllByProduct(product);

            List<OptionResponse> optionResponses = optionMapper.getOptionResponseList(
                    optionRepository.findAllById(
                            productOptions.stream()
                                    .map(pt -> pt.getOption().getId())
                                    .toList()
                    )
            );
            ProductResponse productResponse = productMapper.getProductResponse(product);
            productResponse.setToppings(toppingResponses);
            productResponse.setOptions(optionResponses);
            return productResponse;
        }).toList();
    }
}
